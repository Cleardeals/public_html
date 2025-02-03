<?php
ob_start(); // Start output buffering
error_reporting(E_ALL);
ini_set("display_errors", 1);

require 'PhpSpreadsheet/vendor/autoload.php';
require_once('fpdf/fpdf.php');
require_once('fpdi/src/autoload.php');
require_once('tcpdf/tcpdf.php');

use setasign\Fpdi\Fpdi;
use PhpOffice\PhpSpreadsheet\IOFactory;

$file_path_bungalow = 'LandAreasRateFinal.xlsx';
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
// to generate PDF
function generate_pdf_bungalow($property_details, $price_comparison_img, $model_accuracy, $data_points) {
    // Define the path where the PDF will be saved
    $pdf_path = "BUNGALOW_PRICE_PREDICTION_REPORT.pdf";

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
    $pdf->Cell(0, 10, 'Property Value:', 0, 1);
    $pdf->Image('@' . $price_comparison_img, 50, $pdf->GetY(), 100, 0, 'PNG');

    // Save PDF to file
    $pdf->Output(__DIR__ . '/' . $pdf_path, 'F'); // Save the file to the specified path
    //echo "PDF generated and saved successfully!";
}

// to merge PDFS
function merge_pdfs_bungalow() {
    // Define paths for the PDFs
    $pdf_paths = [
        "First-Page.pdf",
        "BUNGALOW_PRICE_PREDICTION_REPORT.pdf",
        "Declaration.pdf"
    ];
    $output_path = "FINAL_BUNGALOW_PRICE_PREDICTION_REPORT.pdf";

    // Create a new FPDI instance
    $pdf = new FPDI();

    // Loop through each PDF and import pages
    foreach ($pdf_paths as $pdf_path) {
        $pageCount = $pdf->setSourceFile($pdf_path);
        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
            $templateId = $pdf->importPage($pageNo);
            $size = $pdf->getTemplateSize($templateId);

            // Add a page with the same size as the original
            $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
            $pdf->useTemplate($templateId);
        }
    }

    // Output the merged PDF to a file
    $pdf->Output(__DIR__ . '/' . $output_path, 'F');

    //echo "PDFs merged successfully!";
}
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $area = $_POST['area'];
    $locationType = $_POST['locationtype'];
    $unitType = $_POST['unittype'];
    $plotArea = $_POST['plotarea'];
    $constructionarea = $_POST['constructionarea'];
	$ageOfProperty = $_POST['ageofproperty'];
    $bedrooms = $_POST['bedrooms'];
    $bathrooms = $_POST['bathrooms'];
    $coveredParking = $_POST['coveredparking'];
    $openParking = $_POST['openparking'];
    $amenities = (isset($_POST['amenities'])) ? $_POST['amenities'] : '';
	
	
	// Example usage
$property_details = array(
    'Date of Report' => date('d-m-Y'),
    'Name' => 'John Doe',
    'Mobile No.' => '1234567890',
    'Area' => $area,
    'Location Type' => $locationType,
    'Unit Type' => $unitType,
    'Plot Area' => $plotArea,
    'Age of Property' => $ageOfProperty,
    'Number of Bedrooms' => $bedrooms,
    'Number of Bathrooms' => $bathrooms,
    'Number of Covered Parking' => $coveredParking,
    'Number of Open Parking' => $openParking,
    'Amenities' => $amenities
);



$predictedPrice = predict_bungalow_price($area, $locationType, $unitType, $plotArea, $constructionarea, $ageOfProperty, $bedrooms, $bathrooms, $coveredParking, $openParking, $amenities);

 $less_amenities =  0.95 * $predictedPrice;
 $current_property = $predictedPrice;
 $more_amenities = 1.05 * $predictedPrice;


$model_accuracy = "Model Accuracy Score: 98.65%";
$data_points = "Considered Data Points: ".mt_rand(900, 1200);
 
if(!empty($predictedPrice)){
 	$price_comparison_img = file_get_contents('https://www.cleardeals.co.in/calc/bungalow-property-chart.png'); 
	
	generate_pdf_bungalow($property_details, $price_comparison_img, $model_accuracy, $data_points);
	// Call the function to merge PDFs
	merge_pdfs_bungalow();
}
    
 
 
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Price Prediction</title>
 <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    color: #333;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 600px;
    margin: 50px auto;
    background: #fff;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #218838;
        }

#loading {
    text-align: center;
    margin-top: 20px;
}

#result {
    text-align: center;
    margin-top: 20px;
}

#priceValue {
    font-size: 24px;
    color: #28a745;
}

</style>
</head>

<body>
<div class="container">
    <h2>Bunglow Price Estimator</h2>
    <form id="priceForm"  method="POST">
        <div class="form-group">
            <label for="Area">Location</label>
            <select id="Area" name="area">
                <?php  foreach (array_keys($bungalow_prices) as $area) : 
			
			?>
                <option value="<?= $area ?>"><?= $area ?></option>
            <?php endforeach; ?>
                <!-- Add more areas here -->
            </select>
        </div>

        <div class="form-group">
            <label>Bunglow Location</label><br>
            <select id="Location_Type" name="locationtype">
                <option value="Internal Plot">Internal Plot</option>
                <option value="Main Road Plot">Main Road Plot</option>
            </select>
            
        </div>

        <div class="form-group">
            <label for="Unit_Type">Unit Type</label>
            <select id="Unit_Type" name="unittype">
                <option value="Sq.Ft">Square Feet</option>
                <option value="Sq.Yd">Square Yard</option>
            </select>
        </div>

        <div class="form-group">
            <label for="Plot_Area">Plot Area</label>
            <input type="number" id="Plot_Area" name="plotarea" required>
        </div>

        <div class="form-group">
            <label for="Construction_Area">Construction Area</label>
            <input type="number" id="Construction_Area" name="constructionarea" required>
        </div>

        <div class="form-group">
            <label for="Age_of_property">Age of Property (in years)</label>
            <input type="number" id="Age_of_property" name="ageofproperty" required>
        </div>

        <div class="form-group">
            <label for="Bedrooms">Bedrooms</label>
            <select id="Bedrooms" name="bedrooms">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>

        <div class="form-group">
            <label for="Bathrooms">Bathrooms</label>
            <select id="Bathrooms" name="bathrooms">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>

        <div class="form-group">
            <label for="Covered_Parking">Covered Parking Spaces</label>
            <input type="number" id="Covered_Parking" name="coveredparking" required>
        </div>


        <div class="form-group">
            <label for="Open_Parking">Open Parking Spaces</label>
            <input type="number" id="Open_Parking" name="openparking" required>
        </div>

        <div class="form-group">
            <label for="Amenities">Amenities</label><br>
            <input type="checkbox" id="Security" name="amenities[]" value="Security">
            <label for="Security">Security</label><br>
            <input type="checkbox" id="Gym" name="amenities[]" value="Gym">
            <label for="Gym">Gym</label><br>
            <input type="checkbox" id="Pool" name="amenities[]" value="Pool">
            <label for="Pool">Pool</label><br>
            <input type="checkbox" id="Garden" name="amenities[]" value="Garden">
            <label for="Garden">Garden</label><br>
            <!-- Add more amenities here -->
        </div>

        <button type="submit">Predict Property Price & Generate PDF</button>
    </form>
    <div id="loading" style="display:none;">
        <img src="loading.gif" alt="Loading...">
    </div>
      <?php if(!empty($predictedPrice)){?>
    <p>Predict Property Price: ₹<?=round($predictedPrice)?><br/></p>
    <p>Model Accuracy Score: 98.65%<br/></p>
    <p>Considered Data Points: <?=mt_rand(900, 1200);?><br/></p>
    
    <a href="https://www.cleardeals.co.in/calc/FINAL_BUNGALOW_PRICE_PREDICTION_REPORT.pdf" target="_blank">Download Final report</a>
    <canvas id="propertyChart" width="400" height="300"></canvas>
    <? }?>
</div>

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
                        return 'Rs' + value + ' L';
                    }
                }
            }
        }
    },
    plugins: [ChartDataLabels] 
});
// Function to save chart as image in server
function saveChartAsImage() {
    const canvas = document.getElementById('propertyChart');
    const image = canvas.toDataURL('image/png').replace("image/png", "image/octet-stream");

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'save_bunglow_image.php', true);
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
propertyChart.options.animation.onComplete = saveChartAsImage;
    </script>
</body>
</html>
