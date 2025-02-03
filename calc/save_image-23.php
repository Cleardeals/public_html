<?php
if (isset($_POST['image'])) {
    $imageData = $_POST['image'];

    // Remove the "data:image/png;base64," part
    $imageData = str_replace('data:image/octet-stream;base64,', '', $imageData);
    $imageData = str_replace(' ', '+', $imageData);

    // Decode the base64 string
    $image = base64_decode($imageData);

    // Set the directory where you want to save the image
    $directory = $_SERVER['DOCUMENT_ROOT'].'/calc/';
    $filename = 'property-chart.png';
    $filePath = $directory . $filename;

    // Check if a file with the same name already exists
    if (file_exists($filePath)) {
        // Append a timestamp or a unique identifier to the filename
        $newFilename = 'property-chart.png';
        $filePath = $directory . $newFilename;
    }

    // Save the image to the server
    file_put_contents($filePath, $image);

    echo 'Image saved successfully as: ' . basename($filePath);
} else {
    echo 'No image data found!';
}

?>
