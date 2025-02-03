<?php
if (isset($_POST['image'])) {
    $imageData = $_POST['image'];

    // Remove the "data:image/png;base64," part
    $imageData = str_replace('data:image/octet-stream;base64,', '', $imageData);
    $imageData = str_replace(' ', '+', $imageData);

    // Decode the base64 string
    $image = base64_decode($imageData);

    // Set the file path where you want to save the image
    $filePath = $_SERVER['DOCUMENT_ROOT'].'/calc/property-chart.png';

    // Save the image to the server
    file_put_contents($filePath, $image);

    echo 'Successfully done!!';
} else {
    echo 'No image data found!';
}
?>
