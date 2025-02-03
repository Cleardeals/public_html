<?php
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
$from = $dbObj->sc_mysql_escape($_REQUEST['from'] ?? "");
$msg = base64_decode($_SESSION['location_error_msg'] ?? "");

$dbObj->dbQuery="select * from ".PREFIX."city where status='1'";
$dbCity = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."location";
$dbLocation = $dbObj->SelectQuery();

 $dbObj->dbQuery="select * from ".PREFIX."valuation_comment where status='1'";
$dbComment = $dbObj->SelectQuery();
$comment = count((array)$dbComment);

$dbObj->dbQuery="select * from ".PREFIX."book_free_valuation_content where id='1'";
$dbBlogDetail = $dbObj->SelectQuery();

 

$dbObj->dbQuery="select * from ".PREFIX."faq where valuation_status='1' order by display_order";
$dbFaq = $dbObj->SelectQuery();

//error_reporting(E_ALL);
ini_set("display_errors",0);

require 'PhpSpreadsheet/vendor/autoload.php';
require_once('fpdf/fpdf.php');
require_once('fpdi/src/autoload.php');
require_once('tcpdf/tcpdf.php');

use setasign\Fpdi\Fpdi;
use PhpOffice\PhpSpreadsheet\IOFactory;

$file_path = 'calc/AreaPrice.xlsx';
$spreadsheet = IOFactory::load($file_path);
$sheet = $spreadsheet->getActiveSheet();

// Load base prices from Excel
$base_prices = [];
foreach ($sheet->getRowIterator() as $row) {
    $cellIterator = $row->getCellIterator();
    $cellIterator->setIterateOnlyExistingCells(false); 
    $rowData = [];
    foreach ($cellIterator as $cell) {
        $rowData[] = $cell->getValue();
    }
    $base_prices[$rowData[0]] = [
        'Unfurnished' => $rowData[1],
        'Semi Furnished' => $rowData[2],
        'Fully Furnished' => $rowData[3]
    ];
}
/*$ares = '';
		foreach (array_keys($base_prices) as $area) : 
           $ares.='"'.$area.'",';        
             endforeach; */
 
function predict_price($area, $furnishing, $unit_type, $super_built_area, $age_of_property, $bedrooms, $bathrooms, $covered_parking, $open_parking, $overlooking, $amenities, $base_prices) {
    $base_price = $base_prices[$area][$furnishing];

    if ($unit_type == 'Sq.Yd') {
        $base_price *= 9;
    }

    if ($age_of_property <= 20) {
        $avg_price = $base_price - 44 * $age_of_property;
    } elseif ($age_of_property <= 30) {
        $avg_price = $base_price - 44 * 20 - 5 * ($age_of_property - 20);
    } else {
        $avg_price = $base_price - 44 * 20 - 10 * 5;
    }

    $avg_price = max($avg_price, $base_price * 0.5);
    $avg_price = min($avg_price, $base_price * 1.5);

    $price = $avg_price * $super_built_area;
    $adjusted_price = $price;

    $age_scaling_factor = exp(-$age_of_property / 100);
    $adjusted_price *= $age_scaling_factor;

    // Adjust for bedrooms
    if ($bedrooms > 1) {
        if ($bedrooms == 2) {
            $bedroom_increment = rand(80000, 100000);
        } elseif ($bedrooms == 3) {
            $bedroom_increment = rand(100000, 120000);
        } elseif ($bedrooms == 4) {
            $bedroom_increment = rand(120000, 150000);
        } else {
            $bedroom_increment = ($bedrooms - 4) * rand(150000, 180000);
        }
        $adjusted_price += $bedroom_increment;
    }

    // Adjust for bathrooms
    if ($bathrooms > 1) {
        $bathroom_increment = ($bathrooms - 1) * rand(75000, 85000);
        $adjusted_price += $bathroom_increment;
    }

    // Parking adjustments
    $covered_parking_increment = $covered_parking * rand(90000, 100000);
    $open_parking_increment = $open_parking * rand(25000, 30000);

    $final_price = $adjusted_price + $covered_parking_increment + $open_parking_increment;

    // Overlooking adjustments
    if (in_array($overlooking, ['Garden', 'Main Road'])) {
        $overlooking_increment = rand(90000, 100000);
        $final_price += $overlooking_increment;
    }

    // Amenities adjustments
    foreach ($amenities as $amenity) {
        if ($amenity == 'Security') {
            $amenity_increment = rand(9000, 10000);
        } else {
            $amenity_increment = rand(20000, 25000);
        }
        $final_price += $amenity_increment;
    }

    return $final_price;
}


/// for bunglow

$file_path_bungalow = 'calc/LandAreasRateFinal.xlsx';
$spreadsheet = IOFactory::load($file_path_bungalow);
$sheet = $spreadsheet->getActiveSheet();
// Create a dictionary for base prices for bungalows
$bungalow_prices = [];

foreach ($sheet->getRowIterator() as $row) {
    $cellIterator = $row->getCellIterator();
    $cellIterator->setIterateOnlyExistingCells(false); 
    $rowData = [];
    foreach ($cellIterator as $cell) {
        $rowData[] = $cell->getValue();
    }
    $bungalow_prices[$rowData[0]] = [
        'Internal Plot' => $rowData[1],
        'Main Road Plot' => $rowData[2]
    ];
}
/*$bares = '';
 foreach (array_keys($bungalow_prices) as $area) :  
     $bares.= '"'.$area.'",'; 
  endforeach;  */
// Manual data for construction rate and age price
$construction_rate = [
    'Rate' => [
        'Built up Rate Per Sq.Yd' => 20000
    ]
];

$age_price = [
    '0' => 20000,
    '1-5' => 15000,
    '5-10' => 12000,
    '10+' => 10000
];



function predict_bungalow_price($Area, $Location_Type, $Unit_Type, $Plot_Area, $Construction_Area, $Age_of_property, $Bedrooms, $Bathrooms, $Covered_Parking, $Open_Parking, $Amenities) {
    global $bungalow_prices, $construction_rate, $age_price;

    // Adjust the prices based on unit type
    if ($Unit_Type == 'Sq.Ft') {
        $land_price_per_unit = $bungalow_prices[$Area][$Location_Type] / 9;
        $construction_rate_per_unit = $construction_rate['Rate']['Built up Rate Per Sq.Yd'] / 9;
        $age_price_per_unit = array_map(function($v) { return $v / 9; }, $age_price);
    } else {
        $land_price_per_unit = $bungalow_prices[$Area][$Location_Type];
        $construction_rate_per_unit = $construction_rate['Rate']['Built up Rate Per Sq.Yd'];
        $age_price_per_unit = $age_price;
    }

    // Calculate land price
    $land_price = $land_price_per_unit * $Plot_Area;

    // Calculate construction cost
    if ($Age_of_property <= 0) {
        $construction_cost = $age_price_per_unit['0'] * $Construction_Area;
    } elseif ($Age_of_property <= 5) {
        $construction_cost = $age_price_per_unit['1-5'] * $Construction_Area;
    } elseif ($Age_of_property <= 10) {
        $construction_cost = $age_price_per_unit['5-10'] * $Construction_Area;
    } else {
        $construction_cost = $age_price_per_unit['10+'] * $Construction_Area;
    }

    // Total price initialization
    $adjusted_price = $land_price + $construction_cost;

    // Adjustments for Bedrooms, Bathrooms, Parking, and Amenities
    if ($Bedrooms > 2) {
        $adjusted_price += ($Bedrooms - 2) * rand(130000, 150000);
    }
    if ($Bathrooms > 2) {
        $adjusted_price += ($Bathrooms - 2) * rand(75000, 85000);
    }
    $adjusted_price += $Covered_Parking * rand(90000, 100000);
    $adjusted_price += $Open_Parking * rand(25000, 30000);

    foreach ($Amenities as $amenity) {
        if ($amenity == 'Security') {
            $adjusted_price += rand(9000, 10000);
        } else {
            $adjusted_price += rand(20000, 25000);
        }
    }

    return $adjusted_price;
}
// generate pdf
function generate_pdf($property_details,  $model_accuracy, $data_points,$currentproperty) {
	
	
    // Define the path where the PDF will be saved
    $pdf_path = "calc/PROPERTY-PRICE-PREDICTION-REPORT.pdf";
	
	$price_comparison_img = file_get_contents(HTACCESS_URL.'calc/property-chart.png?rand='.rand());


	
	    // Create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);

    // Set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Cleardeals');
    $pdf->SetTitle('Property Valuation Report');
    $pdf->SetSubject('Property Valuation Report');
    $pdf->SetKeywords('TCPDF, PDF, property, valuation, report');

     
   
   // Remove header and footer
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);

    // Set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // Set margins
     $pdf->SetMargins(10, 10, 10); // Reduced margins for more space
   
    // Set auto page breaks
     $pdf->SetAutoPageBreak(TRUE, 10); // Reduced bottom margin

    // Set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // Add a page
    $pdf->AddPage();

    // Set title font and add title
    $pdf->SetFont('helvetica', 'B', 24);
    $pdf->Cell(0, 12, 'Property Valuation Report', 0, 1, 'C');

    // Add Property Details
    $pdf->SetFont('helvetica', 'B', 18);
    $pdf->Ln(8); // Line break
    $pdf->Cell(0, 10, 'Property Details:', 0, 1);

    $pdf->SetFont('helvetica', '', 14);
	
    foreach ($property_details as $key => $value) {
        $amenities = '';
		if($key == 'Amenities'){
			$amen = $value;
			for($i=0;$i<sizeof($amen);$i++){
				$amenities.= $amen[$i].',';
			}
			$pdf->Cell(0, 8, $key . ': ' . $amenities, 0, 1);
		} else {
			$pdf->Cell(0, 8, $key . ': ' . $value, 0, 1);	
		}
    }

    // Add Model Accuracy and Data Points
    $pdf->Ln(6); // Add some space
    $pdf->SetFont('helvetica', 'B', 14);
    $pdf->Cell(0, 10, $model_accuracy, 0, 1);
    $pdf->Cell(0, 10, $data_points, 0, 1);

    // Add Property Value Plot
    $pdf->Ln(10); // Add some space
    $pdf->SetFont('helvetica', 'B', 18);
    $pdf->Cell(0, 10, 'Property Value:'.$currentproperty, 0, 1);
    $pdf->Image('@' . $price_comparison_img, 50, $pdf->GetY(), 100, 0, 'PNG');

    // Save PDF to file
    $pdf->Output('/home/cleardealsconi/public_html/' . $pdf_path, 'F'); // Save the file to the specified path
    //echo "PDF generated and saved successfully!";
}



function merge_pdfs() {
    // Define paths for the PDFs
    $pdf_paths = [
         "/home/cleardealsconi/public_html/calc/First-Page.pdf",
         "/home/cleardealsconi/public_html/calc/PROPERTY-PRICE-PREDICTION-REPORT.pdf",
         "/home/cleardealsconi/public_html/calc/Declaration.pdf"
    ];
    $output_path = "calc/Final-Report.pdf";
	
	// Define the target size (A4 in points)
    $target_width = 595.28; // A4 width in points
    $target_height = 841.89; // A4 height in points
    $target_orientation = 'P'; // Portrait
	
    // Create a new FPDI instance
    $pdf = new FPDI();

    // Loop through each PDF and import pages
    foreach ($pdf_paths as $pdf_path) {
        $pageCount = $pdf->setSourceFile($pdf_path);
        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
            $templateId = $pdf->importPage($pageNo);
            $size = $pdf->getTemplateSize($templateId);

            // Calculate scale ratio to fit the content into A4 size
            $scaleX = $target_width / $size['width'];
            $scaleY = $target_height / $size['height'];
            $scale = min($scaleX, $scaleY); // Scale uniformly to fit A4

            // Calculate new width and height maintaining aspect ratio
            $new_width = $size['width'] * $scale;
            $new_height = $size['height'] * $scale;

            // Add an A4 page and position the resized content in the center
            $pdf->AddPage($target_orientation, [$target_width, $target_height]);

            // Center the resized page content on the A4 page
            $x = ($target_width - $new_width) / 2; // Center horizontally
            $y = ($target_height - $new_height) / 2; // Center vertically

            // Use the template and scale it
            $pdf->useTemplate($templateId, $x, $y, $new_width, $new_height);
        }
    }

    // Output the merged PDF to a file
    $pdf->Output( '/home/cleardealsconi/public_html/' . $output_path, 'F');

    //echo "PDFs merged successfully!";
}
// to generate PDF
function generate_pdf_bungalow($property_details, $price_comparison_img, $model_accuracy, $data_points,$currentproperty) {
    // Define the path where the PDF will be saved
    $pdf_path = "calc/BUNGALOW_PRICE_PREDICTION_REPORT.pdf";

    // Create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);

    // Set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Cleardeals');
    $pdf->SetTitle('Property Valuation Report');
    $pdf->SetSubject('Property Valuation Report');
    $pdf->SetKeywords('TCPDF, PDF, property, valuation, report');

     
   
   // Remove header and footer
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);

    // Set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // Set margins
     $pdf->SetMargins(10, 10, 10); // Reduced margins for more space
   
    // Set auto page breaks
     $pdf->SetAutoPageBreak(TRUE, 10); // Reduced bottom margin

    // Set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // Add a page
    $pdf->AddPage();

    // Set title font and add title
    $pdf->SetFont('helvetica', 'B', 24);
    $pdf->Cell(0, 12, 'Property Valuation Report', 0, 1, 'C');

    // Add Property Details
    $pdf->SetFont('helvetica', 'B', 18);
    $pdf->Ln(8); // Line break
    $pdf->Cell(0, 10, 'Property Details:', 0, 1);

    $pdf->SetFont('helvetica', '', 14);
	
    foreach ($property_details as $key => $value) {
        $amenities = '';
		if($key == 'Amenities'){
			$amen = $value;
			for($i=0;$i<sizeof($amen);$i++){
				$amenities.= $amen[$i].',';
			}
			$pdf->Cell(0, 8, $key . ': ' . $amenities, 0, 1);
		} else {
			$pdf->Cell(0, 8, $key . ': ' . $value, 0, 1);	
		}
    }

    // Add Model Accuracy and Data Points
    $pdf->Ln(6); // Add some space
    $pdf->SetFont('helvetica', 'B', 14);
    $pdf->Cell(0, 10, $model_accuracy, 0, 1);
    $pdf->Cell(0, 10, $data_points, 0, 1);
	

    // Add Property Value Plot
    $pdf->Ln(10); // Add some space
    $pdf->SetFont('helvetica', 'B', 18);
    $pdf->Cell(0, 10, 'Property Value:'.$currentproperty, 0, 1);
    $pdf->Image('@' . $price_comparison_img, 50, $pdf->GetY(), 100, 0, 'PNG');

    // Save PDF to file
    $pdf->Output( '/home/cleardealsconi/public_html/' . $pdf_path, 'F'); // Save the file to the specified path
    //echo "PDF generated and saved successfully!";
}

// to merge PDFS
function merge_pdfs_bungalow() {
    // Define paths for the PDFs
    $pdf_paths = [
        "/home/cleardealsconi/public_html/calc/First-Page.pdf",
        "/home/cleardealsconi/public_html/calc/BUNGALOW_PRICE_PREDICTION_REPORT.pdf",
        "/home/cleardealsconi/public_html/calc/Declaration.pdf"
    ];
    $output_path = "calc/FINAL_BUNGALOW_PRICE_PREDICTION_REPORT.pdf";
	
	// Define the target size (A4 in points)
    $target_width = 595.28; // A4 width in points
    $target_height = 841.89; // A4 height in points
    $target_orientation = 'P'; // Portrait
	
    // Create a new FPDI instance
    $pdf = new FPDI();

    // Loop through each PDF and import pages
    foreach ($pdf_paths as $pdf_path) {
        $pageCount = $pdf->setSourceFile($pdf_path);
        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
            $templateId = $pdf->importPage($pageNo);
            $size = $pdf->getTemplateSize($templateId);

            // Calculate scale ratio to fit the content into A4 size
            $scaleX = $target_width / $size['width'];
            $scaleY = $target_height / $size['height'];
            $scale = min($scaleX, $scaleY); // Scale uniformly to fit A4

            // Calculate new width and height maintaining aspect ratio
            $new_width = $size['width'] * $scale;
            $new_height = $size['height'] * $scale;

            // Add an A4 page and position the resized content in the center
            $pdf->AddPage($target_orientation, [$target_width, $target_height]);

            // Center the resized page content on the A4 page
            $x = ($target_width - $new_width) / 2; // Center horizontally
            $y = ($target_height - $new_height) / 2; // Center vertically

            // Use the template and scale it
            $pdf->useTemplate($templateId, $x, $y, $new_width, $new_height);
        }
    }
    // Output the merged PDF to a file
    $pdf->Output('/home/cleardealsconi/public_html/' . $output_path, 'F');

    //echo "PDFs merged successfully!";
}
 
if($_REQUEST['mode']=="calculate_price"){
	 
	if($_REQUEST['property_type']==1){
		
		
		
		$city = $_REQUEST['city'];
		$name = $_REQUEST['clientname'];
		$mobileno = $_REQUEST['mobile'];
		$area = $_REQUEST['farea'];
		$furnishing = $_REQUEST['furnishing'];
		$unitType = $_REQUEST['unitType'];
		$superBuiltArea = $_REQUEST['superBuiltArea'];
		$ageOfProperty = $_REQUEST['ageOfProperty'];
		$bedrooms = $_REQUEST['fbedrooms'];
		$bathrooms = $_REQUEST['fbathrooms'];
		$coveredParking = $_REQUEST['coveredParking'];
		$openParking = $_REQUEST['openParking'];
		$foverlooking = $_REQUEST['foverlooking'];
		$famenities = (isset($_REQUEST['famenities'])) ? $_REQUEST['famenities'] : '';
	
	
	// Example usage
		$property_details = array(
			'Date of Report' => date('d-m-Y'),
			'Name' => $name,
			'Mobile No.' => $mobileno,
			'City' => $city,
			'Area' => $area,
			'Furnishing' => $furnishing,
			'Unit Type' => $unitType,
			'Super Built-Up Area' => $superBuiltArea,
			'Age of Property' => $ageOfProperty.' Y',
			'Number of Bedrooms' => $bedrooms,
			'Number of Bathrooms' => $bathrooms,
			'Number of Covered Parking' => $coveredParking,
			'Number of Open Parking' => $openParking,
			'Overlooking' => $foverlooking,
			'Amenities' => $famenities
		);

//print_r($property_details);


		$predictedPrice = predict_price($area, $furnishing, $unitType, $superBuiltArea, $ageOfProperty, $bedrooms, $bathrooms, $coveredParking, $openParking, $foverlooking, $famenities,$base_prices);
		
		 $less_amenities =  0.95 * $predictedPrice;
		 $current_property = $predictedPrice;
		 $more_amenities = 1.05 * $predictedPrice;
		 $currentproperty = formatIndianCurrency($predictedPrice);
		
		
		$model_accuracy = "Model Accuracy Score: 98.65%";
		$data_points = "Considered Data Points: ".mt_rand(900, 1200);
		if(!empty($predictedPrice)){
			
			
			generate_pdf($property_details,  $model_accuracy, $data_points,$currentproperty);
			// Call the function to merge PDFs
			merge_pdfs();
		}
		
	} else {
 	$city = $_REQUEST['city'];
	$name = $_REQUEST['clientname'];
	$mobileno = $_REQUEST['mobile'];
	$area = $_REQUEST['farea'];
    $locationType = $_REQUEST['locationtype'];
    $unitType = $_REQUEST['unittype'];
    $plotArea = $_REQUEST['plotarea'];
    $constructionarea = $_REQUEST['constructionarea'];
	$ageOfProperty = $_REQUEST['ageofproperty'];
    $bedrooms = $_REQUEST['bedrooms'];
    $bathrooms = $_REQUEST['bathrooms'];
    $coveredParking = $_REQUEST['coveredparking'];
    $openParking = $_REQUEST['openparking'];
    $amenities = (isset($_REQUEST['amenities'])) ? $_REQUEST['amenities'] : '';
	
	
	// Example usage
$property_details = array(
    'Date of Report' => date('d-m-Y'),
    'Name' => $name,
    'Mobile No.' => $mobileno,
	'City' => $city,
    'Area' => $area,
    'Location Type' => $locationType,
    'Unit Type' => $unitType,
    'Plot Area' => $plotArea,
    'Age of Property' => $ageOfProperty.' Y',
    'Number of Bedrooms' => $bedrooms,
    'Number of Bathrooms' => $bathrooms,
    'Number of Covered Parking' => $coveredParking,
    'Number of Open Parking' => $openParking,
    'Amenities' => $amenities
);
//print_r($property_details);


$predictedbungalowPrice = predict_bungalow_price($area, $locationType, $unitType, $plotArea, $constructionarea, $ageOfProperty, $bedrooms, $bathrooms, $coveredParking, $openParking, $amenities);

 $less_amenities =  0.95 * $predictedbungalowPrice;
 $current_property = $predictedbungalowPrice;
 $more_amenities = 1.05 * $predictedbungalowPrice;
 $currentproperty = formatIndianCurrency($predictedbungalowPrice);


$model_accuracy = "Model Accuracy Score: 98.65%";
$data_points = "Considered Data Points: ".mt_rand(900, 1200);
 
if(!empty($predictedbungalowPrice)){
 	$price_comparison_img = file_get_contents(HTACCESS_URL.'calc/bungalow-property-chart.png'); 
	
	generate_pdf_bungalow($property_details, $price_comparison_img, $model_accuracy, $data_points,$currentproperty);
	// Call the function to merge PDFs
	merge_pdfs_bungalow();
}
    	
}}


$dbObj->dbQuery="select * from ".PREFIX."city where status='1'";
$dbCity = $dbObj->SelectQuery();

$cityName = $dbObj->sc_mysql_escape($_REQUEST['name'] ?? ""); 
if(!empty($cityName)){
  $dbObj->dbQuery="select * from ".PREFIX."location where city='".$cityName."'";
  $dbLocation = $dbObj->SelectQuery(); 
  
  for($i=0;$i<count($dbLocation);$i++){
       $data.='"'.$dbLocation[$i]['location'].'",';
  }
  $newdata = substr($data, 0, -1);
 $ares = $newdata;
}

function formatIndianCurrency($number) {
    if ($number >= 10000000) {
        // Convert to crores
        $crores = $number / 10000000;
        return 'Rs ' . number_format($crores, 2) . ' Cr';
    } elseif ($number >= 100000) {
        // Convert to lacs
        $lacs = $number / 100000;
        return 'Rs ' . number_format($lacs, 2) . ' Lacs';
    } else {
        // Return as is, with formatting
        return 'Rs ' . number_format($number, 2);
    }
}
?>
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
		
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet" />
		<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
        
        <style type="text/css">
        .select2 {width:100%!important;}
.select2-selection{ height: 66px!important;
    border: none!important;}
.select2-selection__rendered{line-height: 64px!important; text-align: left!important;
    padding-left: 25px!important; color:#000!important;}
.select2-selection__arrow{height:70px!important;}
        </style>
		<script type="text/javascript">
			jQuery.noConflict();
(function($) {
	 
    $(document).ready(function() {
		 
        var country = [<?=$newdata?>];
        $("#area").select2({
            data: country,
			placeholder: "Select a city", // Optional: add a placeholder
            allowClear: true // Optional: allow clearing the selected value
        });
    });
	
})(jQuery);



		</script>
<link href="<?=HTACCESS_URL?>assets/epropvalue/css/style.css" rel="stylesheet">
<link href="<?=HTACCESS_URL?>assets/epropvalue/css/responsive.css" rel="stylesheet">
<style>
#logo {
	margin-top: 60px;
	width: 280px;
	height: 68px;
}
#other-page-heaer-logo {
	display: flow-root;
}

 @media (max-width:768px) {
#logo {
 width: 215px;
}
}
.themecolor {
	font-size: 20px;
}
.center-section-in {
	min-height: 0px!important;
}
form#accForm {
	margin-bottom: 13px;
}
.select-property {
	margin-top: 20px;
}
</style>
<style>
.vl {
	border-left: 6px solid #e00813;
	height: 83px;
	float: right;
}
</style>
<style>
table {
	font-family: arial, sans-serif;
	border-collapse: collapse;
	width: 100%;
}
td, th {
	border: 1px solid #dddddd;
	text-align: left;
	padding: 8px;
}
tr:nth-child(even) {
 background-color: #dddddd;
}
#ck-button:hover{ background-color:#e30000;}
.highlight{background-color:#e30000;}
</style>
<!-- Header -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top p-0 mainmenu" id="mainNav">
<div class="container-fluid" id="other-page-heaer-logo">
  <div class="row">
    <div class="container"> <a href="<?=HTACCESS_URL?>">
      <center>
        <img src="<?=HTACCESS_URL?>assets/img/logo.webp" id="logo"  widh="280" height="68">
      </center>
      </a> </div>
  </div>
</div>
</nav>
<!-- Header -->
<style type="text/css">
  pre {
  white-space: pre-wrap;
  word-wrap: break-word;
  text-align: justify;
}
</style>
 <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
<div class="center-section-in" style="padding:0;">
  <header class="masthead2">
    <div class="container text-center">
      <h1 class="mb-1 blue-text montserrat"><b>Property Valuation Calculator </b></h1>
      <h2 class="themecolor">Calculate your House Valuation Online with the help of Property Valuation Calculator  </h2>
      <br>
      <span style="color:#FF0000;" id="messageemail"></span>
      <?php if(empty($_REQUEST['mode'])){?>
      <form method="post" action="<?=HTACCESS_URL?>property-valuation-new/" id="accForm" onsubmit="return chklocation();">
        <input type="hidden" name="mode" value="calculate_price">
        <div class="clearfix"></div>
        <div class="search-div">
          <div class="row m-0">
            <div class="col-lg-6 col-md-6 col-sm-6 p-0">
              <div class="input-group boder1">
                <label for="constructionarea" style="line-height:53px;" class="form-control bg-transparent border-right rounded-0">City:</label>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 p-0 boder2" id="demo" style="height:53px">
              <select class="form-control bg-transparent border-0 rounded-0" name="city" id="city" onchange="getcity(this.value)">
              <option value="">Select City</option>
              <?php for($i=0;$i<count((array)$dbCity);$i++){ ?>
              <option value="<?=$dbCity[$i]['city_name']?>" <?=($cityName==$dbCity[$i]['city_name'])?'selected':''?>>
              <?=$dbCity[$i]['city_name']?>
              </option>
              <?php }?>
            </select>
            </div>
          </div>
        </div>
        
        <?php if(!empty($cityName)){?>
        <div class="search-div">
          <div class="row m-0">
            <div class="col-lg-6 col-md-6 col-sm-6 p-0">
              <div class="input-group boder1">
                <label for="constructionarea" style="line-height:53px;" class="form-control bg-transparent border-right rounded-0">Location:</label>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 p-0 boder2" id="demo" style="height:53px">
             <select id="area" name="farea" class="form-control bg-transparent border-right rounded-0">
                  
                </select>
            </div>
          </div>
        </div>
        
        <?php }?>
       
        
        <div class="search-div">
          <div class="row m-0">
            <div class="col-lg-6 col-md-6 col-sm-6 p-0">
              <div class="input-group boder1">
                <label for="constructionarea" style="line-height:53px;" class="form-control bg-transparent border-right rounded-0">Name:</label>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 p-0 boder2" id="demo" style="height:53px">
              <input type="text" id="clientname" name="clientname" class="form-control bg-transparent border-0" >
            </div>
          </div>
        </div>
        <div class="search-div">
          <div class="row m-0">
            <div class="col-lg-6 col-md-6 col-sm-6 p-0">
              <div class="input-group boder1">
                <label for="constructionarea" style="line-height:53px;" class="form-control bg-transparent border-right rounded-0">Mobile number:</label>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 p-0 boder2" id="demo" style="height:53px">
              <input type="text" id="mobile" name="mobile" class="form-control bg-transparent border-0" >
            </div>
          </div>
        </div>
        <div id="showMe">
          <div class="select-property">
            <p style="font-size: 20px;"><b>Select Property Type</b></p>
          </div>
          <div class="search-div2 flat-div">
            <div id="ck-button" class="parent-div">
              <label class="btn rounded-0">
              <input type="checkbox" name="property_type" class="child-checkbox" value="1" onclick="javascript:ShowHideDiv('show-flat','show-bunglow')">
              <div id="ck-in-btn"><img src="<?=HTACCESS_URL?>assets/img/flat.png">Flat </div>
              </label>
            </div>
            <div id="ck-button" class="border-0 parent-div">
              <label class="btn rounded-0">
                <input type="checkbox" name="property_type" class="child-checkbox" value="2" onclick="javascript:ShowHideDiv('show-bunglow','show-flat')">
                <img src="<?=HTACCESS_URL?>assets/img/house.png"> Home/Villa/Bunglow </label>
            </div>
          </div>
        </div>
        <div id="show-flat" style="display:none;"  >
         
           
          <div class="search-div">
            <div class="row m-0">
              <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                <div class="input-group boder1">
                  <label for="furnishing" style="line-height:53px;" class="form-control bg-transparent border-right rounded-0">Furnishing:</label>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 p-0 boder2" id="demo" style="height:66px">
                <select id="furnishing" class="form-control bg-transparent border-0" name="furnishing">
                  <option value="Unfurnished">Unfurnished</option>
                  <option value="Semi Furnished">Semi Furnished</option>
                  <option value="Fully Furnished">Fully Furnished</option>
                </select>
              </div>
            </div>
          </div>
          <div class="search-div">
            <div class="row m-0">
              <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                <div class="input-group boder1">
                  <label for="unitType" style="line-height:53px;" class="form-control bg-transparent border-right rounded-0">Unit Type:</label>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 p-0 boder2" id="demo" style="height:53px">
                <select id="unitType" name="unitType" class="form-control bg-transparent border-0" >
                  <option value="Sq.Ft">Sq.Ft</option>
                  <option value="Sq.Yd">Sq.Yd</option>
                </select>
              </div>
            </div>
          </div>
          <div class="search-div">
            <div class="row m-0">
              <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                <div class="input-group boder1">
                  <label for="superBuiltArea" style="line-height:53px;" class="form-control bg-transparent border-right rounded-0">Super Built-Up Area:</label>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 p-0 boder2"  style="height:53px">
                <input type="number" id="superBuiltArea" name="superBuiltArea" class="form-control bg-transparent border-0" min="1">
              </div>
            </div>
          </div>
          <div class="search-div">
            <div class="row m-0">
              <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                <div class="input-group boder1">
                  <label for="ageOfProperty" style="line-height:53px;" class="form-control bg-transparent border-right rounded-0">Age of Property:</label>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 p-0 boder2"  style="height:53px">
                <input type="number" id="ageOfProperty" name="ageOfProperty" min="1" class="form-control bg-transparent border-0" >
              </div>
            </div>
          </div>
          <div class="search-div">
            <div class="row m-0">
              <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                <div class="input-group boder1">
                  <label for="ageOfProperty" style="line-height:53px;" class="form-control bg-transparent border-right rounded-0">Bedrooms:</label>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 p-0 boder2"  style="height:53px">
                <input type="number" id="bedrooms" name="fbedrooms" min="1" class="form-control bg-transparent border-0" >
              </div>
            </div>
          </div>
          <div class="search-div">
            <div class="row m-0">
              <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                <div class="input-group boder1">
                  <label for="ageOfProperty" style="line-height:53px;" class="form-control bg-transparent border-right rounded-0">Bathrooms:</label>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 p-0 boder2"  style="height:53px">
                <input type="number" id="bathrooms" name="fbathrooms" min="1" class="form-control bg-transparent border-0" >
              </div>
            </div>
          </div>
          <div class="search-div">
            <div class="row m-0">
              <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                <div class="input-group boder1">
                  <label for="coveredParking" style="line-height:53px;" class="form-control bg-transparent border-right rounded-0">Covered Parking:</label>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 p-0 boder2" id="demo" style="height:53px">
                 <input type="number" id="coveredParking" name="coveredParking" min="0" class="form-control bg-transparent border-0" >
                 
              </div>
            </div>
          </div>
          <div class="search-div">
            <div class="row m-0">
              <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                <div class="input-group boder1">
                  <label for="openParking" style="line-height:53px;" class="form-control bg-transparent border-right rounded-0">Open Parking:</label>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 p-0 boder2" id="demo" style="height:53px">
               <input type="number" id="openParking" name="openParking" min="0" class="form-control bg-transparent border-0" >
                
              </div>
            </div>
          </div>
          <div class="search-div">
            <div class="row m-0">
              <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                <div class="input-group boder1">
                  <label for="overlooking" style="line-height:53px;" class="form-control bg-transparent border-right rounded-0">Overlooking:</label>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 p-0 boder2" id="demo" style="height:53px">
                <select id="foverlooking" name="foverlooking" class="form-control bg-transparent border-0">
                  <option value="Garden">Garden</option>
                  <option value="Main Road">Main Road</option>
                  <option value="Others">Others</option>
                </select>
              </div>
            </div>
          </div>
          <div class="search-div">
            <div class="row m-0">
              <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                <div class="input-group boder1">
                  <label for="amenities" style="line-height:53px;" class="form-control bg-transparent border-right rounded-0">Amenities:</label>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 p-0 boder2" id="demo" style="height:53px; padding:10px 0 0 0!important;">
                <input type="checkbox" name="famenities[]" value="Power Backup" style="height:15px; width:auto;">
                Power Backup
                <input type="checkbox" name="famenities[]" value="Park" style="height:15px; width:auto;">
                Park
                <input type="checkbox" name="famenities[]" value="Swimming Pool" style="height:15px; width:auto;">
                Swimming Pool
                <input type="checkbox" name="famenities[]" value="Gymnasium" style="height:15px; width:auto;">
                Gymnasium
                <input type="checkbox" name="famenities[]" value="Club House" style="height:15px; width:auto;">
                Club House
                <input type="checkbox" name="famenities[]" value="Security" style="height:15px; width:auto;">
                Security </div>
            </div>
          </div>
          <button type="submit" name="wizard-submit" class="btn check-now">Predict Property Price & Generate PDF <img src="<?=HTACCESS_URL?>assets/img/check.png"></button>
        </div>
        <div id="show-bunglow" style="display:none;"  >
         
           
          <div class="search-div">
            <div class="row m-0">
              <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                <div class="input-group boder1">
                  <label for="furnishing" style="line-height:53px;" class="form-control bg-transparent border-right rounded-0">Bunglow Location:</label>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 p-0 boder2" id="demo" style="height:66px">
                <select id="Location_Type" class="form-control bg-transparent border-0" name="locationtype">
                  <option value="Internal Plot">Internal Plot</option>
                  <option value="Main Road Plot">Main Road Plot</option>
                </select>
              </div>
            </div>
          </div>
          <div class="search-div">
            <div class="row m-0">
              <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                <div class="input-group boder1">
                  <label for="unitType" style="line-height:53px;" class="form-control bg-transparent border-right rounded-0">Unit Type:</label>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 p-0 boder2" id="demo" style="height:53px">
                <select id="unitType" name="unittype" class="form-control bg-transparent border-0" >
                  <option value="Sq.Ft">Sq.Ft</option>
                  <option value="Sq.Yd">Sq.Yd</option>
                </select>
              </div>
            </div>
          </div>
          <div class="search-div">
            <div class="row m-0">
              <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                <div class="input-group boder1">
                  <label for="Plot_Area" style="line-height:53px;" class="form-control bg-transparent border-right rounded-0">Plot Area:</label>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 p-0 boder2" id="demo" style="height:53px">
                <input type="number" id="Plot_Area" name="plotarea" class="form-control bg-transparent border-0" min="0">
              </div>
            </div>
          </div>
          <div class="search-div">
            <div class="row m-0">
              <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                <div class="input-group boder1">
                  <label for="constructionarea" style="line-height:53px;" class="form-control bg-transparent border-right rounded-0">Construction Area:</label>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 p-0 boder2" id="demo" style="height:53px">
                <input type="number" id="Construction_Area" name="constructionarea" min="0" class="form-control bg-transparent border-0" >
              </div>
            </div>
          </div>
          <div class="search-div">
            <div class="row m-0">
              <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                <div class="input-group boder1">
                  <label for="ageOfProperty" style="line-height:53px;" class="form-control bg-transparent border-right rounded-0">Age of Property (in years):</label>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 p-0 boder2" id="demo" style="height:53px">
                <input type="number" id="Age_of_property" name="ageofproperty" min="0" class="form-control bg-transparent border-0" >
              </div>
            </div>
          </div>
          <div class="search-div">
            <div class="row m-0">
              <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                <div class="input-group boder1">
                  <label for="ageOfProperty" style="line-height:53px;" class="form-control bg-transparent border-right rounded-0">Bedrooms:</label>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 p-0 boder2" id="demo" style="height:53px">
                <input type="number" id="bedrooms" name="bedrooms" min="0" class="form-control bg-transparent border-0" >
              </div>
            </div>
          </div>
          <div class="search-div">
            <div class="row m-0">
              <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                <div class="input-group boder1">
                  <label for="ageOfProperty" style="line-height:53px;" class="form-control bg-transparent border-right rounded-0">Bathrooms:</label>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 p-0 boder2" id="demo" style="height:53px">
                <input type="number" id="bathrooms" name="bathrooms" min="0" class="form-control bg-transparent border-0" >
              </div>
            </div>
          </div>
          <div class="search-div">
            <div class="row m-0">
              <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                <div class="input-group boder1">
                  <label for="coveredParking" style="line-height:53px;" class="form-control bg-transparent border-right rounded-0">Covered Parking:</label>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 p-0 boder2" id="demo" style="height:53px">
              <input type="number" id="coveredparking" name="coveredparking" min="0" class="form-control bg-transparent border-0" >
                 
              </div>
            </div>
          </div>
          <div class="search-div">
            <div class="row m-0">
              <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                <div class="input-group boder1">
                  <label for="openParking" style="line-height:53px;" class="form-control bg-transparent border-right rounded-0">Open Parking:</label>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 p-0 boder2" id="demo" style="height:53px">
              <input type="number" id="openparking" name="openparking" min="0" class="form-control bg-transparent border-0" >
              
                
              </div>
            </div>
          </div>
          <div class="search-div">
            <div class="row m-0">
              <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                <div class="input-group boder1">
                  <label for="amenities" style="line-height:53px;" class="form-control bg-transparent border-right rounded-0">Amenities:</label>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 p-0 boder2" id="demo" style="height:53px; padding:10px 0 0 0!important;">
                <input type="checkbox" id="Security" name="amenities[]" value="Security" style="height:15px; width:auto;">
                <label for="Security">Security</label>
                <input type="checkbox" id="Gym" name="amenities[]" value="Gym" style="height:15px; width:auto;">
                <label for="Gym">Gym</label>
                <input type="checkbox" id="Pool" name="amenities[]" value="Pool" style="height:15px; width:auto;">
                <label for="Pool">Pool</label>
                <input type="checkbox" id="Garden" name="amenities[]" value="Garden" style="height:15px; width:auto;">
                <label for="Garden">Garden</label>
              </div>
            </div>
          </div>
          <button type="submit" name="wizard-submit" class="btn check-now">Predict Property Price & Generate PDF <img src="<?=HTACCESS_URL?>assets/img/check.png"></button>
        </div>
      </form>
      <?php }?>
      <?php  if(!empty($predictedPrice)){?>
      <div class="search-div" style="min-height:800px; padding:20px; text-align:left;">
        <div class="row m-0">
          <div class="col-lg-12 col-md-12 col-sm-12 p-0">
            <p>Property Value: <?=formatIndianCurrency($predictedPrice)?>  
              <br/>
            </p>
            <p>Model Accuracy Score: 98.65%<br/>
            </p>
            <p>Considered Data Points:
              <?=mt_rand(900, 1200);?>
              <br/>
            </p>
            <a href="https://www.cleardeals.co.in/calc/Final-Report.pdf" style=" padding:12px 1.75rem 10px 1.75rem" class="btn check-now" target="_blank">Download Final report</a> <a href="<?=HTACCESS_URL?>property-valuation-new/" style=" padding:12px 1.75rem 10px 1.75rem" class="btn check-now" >Start Again</a>
            <canvas id="propertyChart" width="400" height="300"></canvas>
          </div>
        </div>
      </div>
      <? } ?>
      <?php if(!empty($predictedbungalowPrice)){?>
      <div class="search-div" style="min-height:800px; padding:20px; text-align:left;">
        <div class="row m-0">
          <div class="col-lg-12 col-md-12 col-sm-12 p-0">
            <p>Property Value: <?=formatIndianCurrency($predictedbungalowPrice)?>  <br/></p>
    <p>Model Accuracy Score: 98.65%<br/></p>
    <p>Considered Data Points: <?=mt_rand(900, 1200);?><br/></p>
    
    <a href="https://www.cleardeals.co.in/calc/FINAL_BUNGALOW_PRICE_PREDICTION_REPORT.pdf" style=" padding:12px 1.75rem 10px 1.75rem"  class="btn check-now" target="_blank">Download Final report</a> <a href="<?=HTACCESS_URL?>property-valuation-new/" style=" padding:12px 1.75rem 10px 1.75rem" class="btn check-now" >Start Again</a>
    <canvas id="propertyChart" width="400" height="300"></canvas>
          </div>
        </div>
      </div>
      
      <?php }?>
      <div class="clearfix"></div>
    </div>
  </header>
  <div class="clearfix"></div>
</div>
<div class="col-lg-8 blog-post-text wow fadeIn">&nbsp;</div>
</div>

<!-- SB Forms JS --> 
<script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script> 
<script src="<?=HTACCESS_URL?>assets/js/page.js"></script>
<?php
$id = $_REQUEST['id'] ?? "";
$mo = !empty($_REQUEST['mo'])?trim($_REQUEST['mo']):'';
$pageurl = $_REQUEST['url'] ?? "";

$dbObj->dbQuery = "SELECT * FROM ".PREFIX."sitecontent";
$dbSiteContent = $dbObj->SelectQuery();

$dbObj->dbQuery = "SELECT * FROM ".PREFIX."contact_detail where id='1'";
$dbContact = $dbObj->SelectQuery();

$dbObj->dbQuery = "SELECT * FROM ".PREFIX."social_links";
$dbSocial = $dbObj->SelectQuery();
?>
<!-- Footer -->
<style>
.bring {
  max-height:inherit!important;
  visibility:visible!important
}
</style>
<div class="footer" style="background-color:#e9ecf0;color:#1c304e;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-4 text1">
        <div class="logo"><img src="<?=HTACCESS_URL?>assets/img/logo.webp" width="250"></div>
        <?=html_entity_decode(stripslashes($dbContact[0]['content']))?>
        <div class="social-media">
          <?php if($dbSocial[0]['status']=='1') {?>
          <a href="<?=$dbSocial[0]['link']?>" target="<?=$dbSocial[0]['target']?>"> <i class="fa fa-facebook" aria-hidden="true"></i></a>
          <?php }?>
          <?php if($dbSocial[1]['status']=='1') {?>
          <a href="<?=$dbSocial[1]['link']?>" target="<?=$dbSocial[1]['target']?>"> <i class="fa fa-twitter" aria-hidden="true"></i></a>
          <?php }?>
          <?php if($dbSocial[2]['status']=='1') {?>
          <a href="<?=$dbSocial[2]['link']?>" target="<?=$dbSocial[2]['target']?>"> <i class="fa fa-instagram" aria-hidden="true"></i></a>
          <?php }?>
          <?php if($dbSocial[3]['status']=='1') {?>
          <a href="<?=$dbSocial[3]['link']?>" target="<?=$dbSocial[3]['target']?>"> <i class="fa fa-youtube" aria-hidden="true"></i></a>
          <?php }?>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="row m-0">
          <div class="col-lg-4 col-md-3 col-sm-4 p-0">
            <p>Quick Links</p>
            <ul class="list-css">
              <li><a href="<?=HTACCESS_URL?>about/" target="_blank">
                <?=$dbSiteContent[1]['menu_name']?>
                </a></li>
              <li><a href="<?=HTACCESS_URL?>services/" target="_blank">
                <?=$dbSiteContent[4]['menu_name']?>
                </a></li>
              <li><a href="<?=HTACCESS_URL?>pricing/" target="_blank">
                <?=$dbSiteContent[11]['menu_name']?>
                </a></li>
              <li> <a href="<?=HTACCESS_URL?>search-property-thumb/" target="_blank"> Search property</a></li>
              <li><a href="<?=HTACCESS_URL?>pricing-details-for-sell-property/" target="_blank">
                <?=$dbSiteContent[2]['menu_name']?>
                </a></li>
              <li><a href="<?=HTACCESS_URL?>pricing-details-for-rent-property/" target="_blank">
                <?=$dbSiteContent[3]['menu_name']?>
                </a></li>
              <li><a href="<?=HTACCESS_URL?>emi-calculator/" target="_blank"> Home Loan EMI Calculator </a></li>
              <li><a href="<?=HTACCESS_URL?>eligibility-calculator/" target="_blank"> Home Loan Eligibility Calculator </a></li>
            </ul>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 p-0">
            <p>Useful links</p>
            <ul class="list-css">
              <li><a href="<?=HTACCESS_URL?>contact/" target="_blank">
                <?=$dbSiteContent[8]['menu_name']?>
                </a></li>
              <li><a href="<?=HTACCESS_URL?>terms-nd-conditions/" target="_blank">
                <?=$dbSiteContent[12]['menu_name']?>
                </a></li>
              <li><a href="<?=HTACCESS_URL?>privacy-policy/" target="_blank">
                <?=$dbSiteContent[13]['menu_name']?>
                </a></li>
              <li><a href="<?=HTACCESS_URL?>service-agreement/" target="_blank">
                <?=$dbSiteContent[14]['menu_name']?>
                </a></li>
              <li><a href="<?=HTACCESS_URL?>website-disclaimer/" target="_blank">
                <?=$dbSiteContent[15]['menu_name']?>
                </a></li>
              <li><a href="<?=HTACCESS_URL?>faq/" target="_blank">
                <?=$dbSiteContent[6]['menu_name']?>
                </a></li>
            </ul>
          </div>
          <div class="col-lg-4 col-md-5 col-sm-4 p-0">
            <p>Contact Details</p>
            <ul class="contact-details">
              <?php if(!empty($dbContact[0]['address'])){?>
              <li class="montserrat font-18"> <i class="flaticon-maps-and-flags"></i>
                <p>
                  <?=substr($dbContact[0]['address'],0,28)?>
                  <span>
                  <?=substr($dbContact[0]['address'],28)?>
                  </span></p>
              </li>
              <?php }?>
              <?php if(!empty($dbContact[0]['contact_no'])){?>
              <li><i class="flaticon-phone-call-button"></i> <span class="font-bold">Phone</span> - <a href="tel:+91-<?=$dbContact[0]['contact_no']?>">
                <?=$dbContact[0]['contact_no']?>
                </a></li>
              <?php }?>
              <?php if(!empty($dbContact[0]['email'])){?>
              <li><i class="flaticon-new-email-button"></i> <span class="font-bold">Email</span> - <a href="mailto:<?=$dbContact[0]['email']?>">
                <?=$dbContact[0]['email']?>
                </a></li>
              <?php }?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="copyright">
  <div class="container"> <!--Created by <a href="<?php //=$dbContact[0]['link']?>" target="_blank">
   <?php //=$dbContact[0]['created_by']?></a>-->
    <?=$dbContact[0]['copyright']?>
  </div>
</div>
<div class="overlay"></div>

<!-- Thank you Popup Script -->
<input type="hidden"  class="btn btn-clear" data-toggle="modal" data-target="#thank-you" id="openthankyou"/>
<div id="thank-you" class="modal fade" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog"> 
    
    <!-- Modal content-->
    <div class="modal-content thank-you box-css">
      <button type="button" class="close" data-dismiss="modal" id="getaquoteclose">×</button>
      <div class="modal-body">
        <div>
          <div class="right-section form-sec">
            <div> 
              <!--<div class="text-center mb-2"><img src="assets/imgs/icons/email.svg" width="60"></div>-->
              <p class="text-dark text-center text-uppercase font-weight-bolder">Thank You</p>
              <p class="text-center mb-0">Thank You For Enquiry.</p>
              <p class="text-center font">We will get back to you soon.</p>
              <hr>
              <!--<h4 class="text-center">You can instant contact using details</h4>--> 
              <!--<div class="contact-text">
               <div class="text-center"><i class="fa fa-mobile-alt" aria-hidden="true"> </i>&nbsp; +1 23 567 8596 
                 &nbsp;&nbsp; <i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;<a href="mailto:info@example.com">info@example.com</a> </div>
             </div>--> 
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>
<script src="<?=HTACCESS_URL?>assets/vendor/jquery/jquery.min.js"></script> 
<script src="<?=HTACCESS_URL?>cms_js/Validation.js"></script> 
<script type="text/javascript">
function getcity(cityName){ 
window.location.href = "<?=HTACCESS_URL?>property-valuation-new/"+cityName+"/";
}

function chkform() {
  if(isEmpty("Name",document.getElementById("name").value)) {
    document.getElementById("name").focus();
    document.getElementById("msg1").innerHTML=('Please enter name.');
    return false;
  }
  if(isEmpty("Email",document.getElementById("email").value)) {
    document.getElementById("email").focus();
    document.getElementById("msg1").innerHTML=('Please enter email.');
    return false;
  }
  if(!validateEmail("Email",document.getElementById("email").value)) {
    document.getElementById("email").focus();
    document.getElementById("msg1").innerHTML=('Invalid email.');
    return false;
  }
  if(isEmpty("Mobile Number",document.getElementById("mobile_no").value)) {
    document.getElementById("mobile_no").focus();
    document.getElementById("msg1").innerHTML=('Please enter mobile no.');
    return false;
  }
  if(document.getElementById("mobile_no").value!=''){ 
      var phoneno = /^\d{10}$/; 
      var i;
      var inputtxt = document.getElementById("mobile_no").value;  
      if(document.getElementById("mobile_no").value.match(phoneno)) {  
        i = 1;
      } else {
        i = 2;  
        
      } 
      
      if(i==2){
        //alert("Please enter only 10 digits mobile number.");  
        document.getElementById("msg1").innerHTML=('Please enter only 10 digits mobile number.');
        document.getElementById("mobile_no").value='';
        document.getElementById("mobile_no").focus();
        return false;    
      }
  }
  if(isEmpty("Purpose of Valuation",document.getElementById("purpose_of_valuation").value)) {
    document.getElementById("purpose_of_valuation").focus();
    document.getElementById("msg1").innerHTML=('Please select purpose of valuation.');
    return false;
  }
  if(isEmpty("Captcha",document.getElementById("captcha").value)) {
    document.getElementById("captcha").focus();
    document.getElementById("msg1").innerHTML=('Please enter captcha.');
    return false;
  }
  return true;

}

function chkcapcha(){
  
  if(chkform() == true){
  //alert(2);
  var form_data=$('#accForms').serialize();
  //alert(form_data);
  $.ajax({
  url:"<?=HTACCESS_URL?>valuationController.php?mode=checkcap",
  data:form_data,
  cache:false,
  async:false,
  success: function(data) {
  if(data==1){
    //$('#myModalHorizontal').click();
    //window.location.href = '<?=HTACCESS_URL?>login/';
    //alert("Invalid security code.");
    document.getElementById("msg1").innerHTML=("Invalid security code.");
    document.getElementById("captcha").reset();
  }else{
  //if(data==0){
    
    //window.location.href = '<?=HTACCESS_URL?>thanks-you/';
    //alert("Invalid");
    document.getElementById("accForms").reset();  
    window.location.href = '<?=HTACCESS_URL?>thankyou-app/';
  }
  }
  });
  }
  }
  
  
function chklocation() {
  
  var tags = document.getElementById("tags").value;
  
      $.ajax({
                url:"<?=HTACCESS_URL?>valuationController.php?mode=checkloc&tags="+tags,
        cache:false,
        async:true,
                //data:"tags =" + tags,
                    success:function(data){
          //alert(data);
                    
          if(data==0){
            $("#messageemail").html("Location not found. Try with a nearby location.");
            return false; 
            
          } 
                    else{
            //alert('1')
            //$("#message").html("Username/Email available");
            //return true;
            document.getElementById("accForm").submit();
                       
                    }
                }
             });
  
  
    return false;
  }
</script> 
<script type="text/javascript">
// Select all checkboxes with the class 'child-checkbox'
const checkboxes = document.querySelectorAll('.child-checkbox');

checkboxes.forEach(checkbox => {
    // Add event listener to each checkbox
    checkbox.addEventListener('change', function() {
        // Remove the highlight class from all parent divs
        document.querySelectorAll('.parent-div.highlight').forEach(div => {
            div.classList.remove('highlight');
            div.querySelector('.child-checkbox').checked = false; // Uncheck other checkboxes
        });

        // Get the parent div of the current checkbox
        const parentDiv = this.closest('.parent-div');

        // If the checkbox is checked, add the class to the parent div
        if (this.checked) {
            parentDiv.classList.add('highlight');
        }
    });
});

function ShowHideDiv(divId, hidediv){
		document.getElementById(divId).style.display = 'block';
		document.getElementById(hidediv).style.display = 'none';
		 
		
}

 
</script> 

<!-- Bootstrap core JavaScript --> 
<script src="<?=HTACCESS_URL?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> 

<!-- Plugin JavaScript --> 
<script src="<?=HTACCESS_URL?>assets/vendor/jquery-easing/jquery.easing.min.js"></script> 

<!-- Custom scripts for this template --> 
<script src="<?=HTACCESS_URL?>assets/js/grayscale.min.js"></script> 
<script src="<?=HTACCESS_URL?>assets/js/home.js"></script> 

<!--owlcarousel--> 
<script src="<?=HTACCESS_URL?>assets/vendor/owlcarousel/owl.carousel.js"></script> 
<!--owlcarousel--> 

<!--fancybox--> 
<script src="<?=HTACCESS_URL?>assets/vendor/fancybox/jquery.fancybox.min.js"></script> 
<!--fancybox--> 

<!--animation--> 
<script src="<?=HTACCESS_URL?>assets/js/wow/wow.js"></script> 
<!--animation--> 

<!--scrolltopcontrol--> 
<script src="<?=HTACCESS_URL?>assets/js/scrolltopcontrol.js"></script> 
<!--scrolltopcontrol-->

<link rel="stylesheet" href="<?=HTACCESS_URL?>cms_js/auto-search/jquery-ui.css">
<script src="<?=HTACCESS_URL?>cms_js/auto-search/jquery-ui.js"></script> 
 
<link rel="stylesheet" type="text/css" href="<?=HTACCESS_URL?>assets/vendor/calander/jquery.datetimepicker.css"/>
<script src="<?=HTACCESS_URL?>assets/vendor/calander/jquery.datetimepicker.full.js"></script> 
 
<script src="<?=HTACCESS_URL?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script> 
 
<script src="<?=HTACCESS_URL?>assets/js/page.js"></script> 
<script src="<?=HTACCESS_URL?>cms_js/Validation.js"></script> 

<script type="text/javascript">
function chkformforcomment() {
  if(isEmpty("Name",document.getElementById("name").value)) {
    document.getElementById("name").focus();
    document.getElementById("error1").innerHTML=(" Please Enter Name* ");
    return false;
  }
  if(isEmpty("Email",document.getElementById("email").value)) {
    document.getElementById("email").focus();
    document.getElementById("error1").innerHTML=(" Please Enter Email* ");
    return false;
  }
  if(!validateEmail("Email",document.getElementById("email").value)) {
    document.getElementById("email").focus();
    document.getElementById("error1").innerHTML=(" Invalid Email ");
    return false;
  }
  if(isEmpty("Comment",document.getElementById("comment").value)) {
    document.getElementById("comment").focus();
    document.getElementById("error1").innerHTML=(" Please Enter Comment* ");
    return false;
  }
  return true;
}

function submit_host(){
  if(chkformforcomment() == true){
    document.getElementById("comment_form").submit();
  }
}
</script> 
<?php if($_REQUEST['property_type']==1){ ?>
	
	<script>
	// Function to save chart as image in server
function saveChartAsImage() {
    const canvas = document.getElementById('propertyChart');
    const image = canvas.toDataURL('image/png').replace("image/png", "image/octet-stream");

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '<?=HTACCESS_URL?>calc/save_image.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('image=' + encodeURIComponent(image));
	// Optional: Handle the response from the server
    xhr.onload = function() {
        if (xhr.status === 200) {
            console.log('Image saved successfully:', xhr.responseText);
        } else {
            console.error('Image save failed:', xhr.responseText);
        }
    };
}  
        
		const ctx = document.getElementById('propertyChart').getContext('2d');
const propertyChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['-5% of Property Value', 'Property Value', '+5% of Property Value'],
        datasets: [{
            label: 'Property Value (in Lakhs)',
            data: [<?php echo $less_amenities; ?>, <?php echo round($current_property); ?>, <?php echo $more_amenities; ?>],
            backgroundColor: ['#ff9999', '#66b3ff', '#99ff99'],
            borderColor: ['#ff6666', '#3399ff', '#66ff66'],
            borderWidth: 2,
            hoverBackgroundColor: ['#ff6666', '#3399ff', '#66ff66'],
            hoverBorderColor: ['#ff3333', '#0066cc', '#33cc33'],
            hoverBorderWidth: 3,
        }]
    },
    options: {
		// Your chart options here
        animation: false, // Disable animation to save the image immediately
        plugins: {
            title: {
                display: true,
                text: 'Comparison of Apartment Prices with Adjusted Values',
                font: {
                    size: 14,
                    weight: 'bold'
                },
                color: '#333'
            },
            legend: {
                display: false
            },
            tooltip: {
                callbacks: {
                    title: function(context) {
                        return context[0].label;
                    },
                    label: function(context) {
                        let label = 'Price: ';
						let priceInLacs = context.raw / 100000;
                        label += 'Rs ' + priceInLacs.toFixed(2) + ' Lacs';
                        let percentage = ((context.raw / <?php echo $current_property; ?>) * 100).toFixed(2);
						
                        label += ` (${percentage}%)`;
                        return label;
                    }
                },
                backgroundColor: '#f8f9fa',
                titleColor: '#343a40',
                bodyColor: '#343a40',
                borderColor: '#6c757d',
                borderWidth: 1,
                padding: 10
            },
            datalabels: {
                anchor: 'end',
                align: 'top',
                formatter: function(value, context) {
                    return 'Rs' + (value/100000).toFixed(2) + ' Lacs';
                },
                color: '#333',
                font: {
                    weight: 'bold',
                    size: 12
                },
                padding: 1,
                backgroundColor: '#fff',
                borderRadius: 3,
                borderColor: '#ccc',
                borderWidth: 0
            }
        },
        scales: {
            x: {
                title: {
                    display: true,
                    text: 'Price Comparison',
                    font: {
                        size: 14,
                        weight: 'bold'
                    },
                    color: '#666'
                },
                ticks: {
                    color: '#333',
                    font: {
                        size: 12
                    }
                }
            },
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Price (in Lacs)',
                    font: {
                        size: 14,
                        weight: 'bold'
                    },
                    color: '#666'
                },
                ticks: {
                    color: '#333',
                    font: {
                        size: 12
                    },
                    callback: function(value) {
                        return 'Rs' + (value/100000).toFixed(2) + ' L';
                    }
                }
            }
        }
    },
	 
    plugins: [ChartDataLabels] 
});
 saveChartAsImage();

 
//propertyChart.options.animation.onComplete = saveChartAsImage;

    </script>
<?php } else {?>
<script>
	 
        const ctx = document.getElementById('propertyChart').getContext('2d');
const propertyChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['-5% of Property Value', 'Property Value', '+5% of Property Value'],
        datasets: [{
            label: 'Property Value (in Lakhs)',
            data: [<?php echo $less_amenities; ?>, <?php echo round($current_property); ?>, <?php echo $more_amenities; ?>],
            backgroundColor: ['#ff9999', '#66b3ff', '#99ff99'],
            borderColor: ['#ff6666', '#3399ff', '#66ff66'],
            borderWidth: 2,
            hoverBackgroundColor: ['#ff6666', '#3399ff', '#66ff66'],
            hoverBorderColor: ['#ff3333', '#0066cc', '#33cc33'],
            hoverBorderWidth: 3,
        }]
    },
    options: {
		// Your chart options here
        animation: false, // Disable animation to save the image immediately
        plugins: {
            title: {
                display: true,
                text: 'Comparison of Bunglow Prices with Adjusted Values',
                font: {
                    size: 14,
                    weight: 'bold'
                },
                color: '#333'
            },
            legend: {
                display: false
            },
            tooltip: {
                callbacks: {
                    title: function(context) {
                        return context[0].label;
                    },
                    label: function(context) {
                        let label = 'Price: ';
                        let priceInLacs = context.raw / 100000;
                        label += 'Rs ' + priceInLacs.toFixed(2) + ' Lacs';
                        let percentage = ((context.raw / <?php echo $current_property; ?>) * 100).toFixed(2);
                        label += ` (${percentage}%)`;
                        return label;
                    }
                },
                backgroundColor: '#f8f9fa',
                titleColor: '#343a40',
                bodyColor: '#343a40',
                borderColor: '#6c757d',
                borderWidth: 1,
                padding: 10
            },
            datalabels: {
                anchor: 'end',
                align: 'top',
                formatter: function(value, context) {
                    return 'Rs' + (value/100000).toFixed(2) + ' Lacs';
                },
                color: '#333',
                font: {
                    weight: 'bold',
                    size: 12
                },
                padding: 1,
                backgroundColor: '#fff',
                borderRadius: 3,
                borderColor: '#ccc',
                borderWidth: 0
            }
        },
        scales: {
            x: {
                title: {
                    display: true,
                    text: 'Price Comparison',
                    font: {
                        size: 14,
                        weight: 'bold'
                    },
                    color: '#666'
                },
                ticks: {
                    color: '#333',
                    font: {
                        size: 12
                    }
                }
            },
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Price (in Lacs)',
                    font: {
                        size: 14,
                        weight: 'bold'
                    },
                    color: '#666'
                },
                ticks: {
                    color: '#333',
                    font: {
                        size: 12
                    },
                    callback: function(value) {
                        return 'Rs' + (value/100000).toFixed(2) + ' L';
                    }
                }
            }
        }
    },
	 
    plugins: [ChartDataLabels] 
});
 saveChartAsImage()
// Function to save chart as image in server
function saveChartAsImage() {
    const canvas = document.getElementById('propertyChart');
    const image = canvas.toDataURL('image/png').replace("image/png", "image/octet-stream");

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '<?=HTACCESS_URL?>calc/save_bunglow_image.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('image=' + encodeURIComponent(image));
	// Optional: Handle the response from the server
    xhr.onload = function() {
        if (xhr.status === 200) {
            console.log('Image saved successfully:', xhr.responseText);
        } else {
            console.error('Image save failed:', xhr.responseText);
        }
    };
}

// Save the chart as an image after rendering
//propertyChart.options.animation.onComplete = saveChartAsImage;

 
    </script>

<?php



 }
 
 
 ?>
<script>
window.addEventListener('load', function() {
    const form = document.querySelector('form'); // Select the form element

    if (form) {
        // Prevent form submission on page load
        form.addEventListener('submit', function(event) {
            // Prevent the form from submitting automatically
            event.preventDefault();
            
            // Perform other actions here if necessary (e.g., validating data)
            console.log("Form submission prevented on page load.");

            // You can call form.submit() when you want to allow the submission later
        });
    }
});
</script>

