<?php
if(isset($_POST['file_name'])) {
    $fileName = $_POST['file_name'];

    $rootDirectory = __DIR__ . '/uploads';

    $newFilePath = $rootDirectory . '/' . $fileName;

    if (!file_exists($newFilePath)) {
        if (file_put_contents($newFilePath, '') !== false) {
            echo "Text file '$fileName' created successfully.";
        } else {
            echo "Error: Unable to create text file '$fileName'.";
        }
    } else {
        echo "Error: Text file '$fileName' already exists.";
    }
} else {
    echo "Error: File name not provided.";
}
?>
