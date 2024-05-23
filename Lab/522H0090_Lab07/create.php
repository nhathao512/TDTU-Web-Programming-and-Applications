<?php
if(isset($_POST['folder_name'])) {
    $folderName = $_POST['folder_name'];

    $rootDirectory = __DIR__ . '/uploads';

    $newFolderPath = $rootDirectory . '/' . $folderName;

    if (!file_exists($newFolderPath)) {
        if (mkdir($newFolderPath)) {
            echo "Folder '$folderName' created successfully.";
        } else {
            echo "Error: Unable to create folder '$folderName'.";
        }
    } else {
        echo "Error: Folder '$folderName' already exists.";
    }
} else {
    echo "Error: Folder name not provided.";
}
?>
