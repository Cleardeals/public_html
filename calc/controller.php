<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $area = $_POST['area'];
    $furnishing = $_POST['furnishing'];
    $unit_type = $_POST['unit_type'];
    $super_built_area = $_POST['super_built_area'];
    $age_of_property = $_POST['age_of_property'];
    $bedrooms = $_POST['bedrooms'];
    $bathrooms = $_POST['bathrooms'];
    $covered_parking = $_POST['covered_parking'];
    $open_parking = $_POST['open_parking'];
    $overlooking = $_POST['overlooking'];
    $amenities = implode(',', $_POST['amenities']);
    $client_name = $_POST['client_name'];
    $mobile_no = $_POST['mobile_no'];

    $command = escapeshellcmd("python3 ApartmentPropertyValuation.py $area $furnishing $unit_type $super_built_area $age_of_property $bedrooms $bathrooms $covered_parking $open_parking $overlooking $amenities");
   echo  $output = shell_exec($command);
    
   
    
   // $_POST['predicted_price'] = $output;
    include 'index.php';
}
?>
