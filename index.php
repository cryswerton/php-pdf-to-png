<?php
// Check if Imagick is available
if (!class_exists('Imagick')) {
    die('Imagick is not installed or enabled on this server.');
}

// Directory to save images
$targetDir = 'images';
if (!is_dir($targetDir)) {
    mkdir($targetDir, 0777, true); // Create directory if it doesn't exist
}

// Path to the PDF file
$pdfFile = 'file.pdf'; // Update this to your PDF file path

try {
    // Create a new Imagick object
    $imagick = new Imagick();
    
    // Read the PDF file
    $imagick->readImage($pdfFile);

    // Loop through each page
    foreach ($imagick as $index => $page) {
        // Set the format to PNG
        $page->setImageFormat('png');
        
        // Create a file name for each page
        $outputFile = sprintf('%s/page-%d.png', $targetDir, $index + 1);
        
        // Write the image to the output file
        $page->writeImage($outputFile);
    }

    // Clear the Imagick object
    $imagick->clear();
    $imagick->destroy();
    
    echo 'PDF pages have been converted to PNG images successfully.';

} catch (Exception $e) {
    echo 'An error occurred: ' . $e->getMessage();
}
