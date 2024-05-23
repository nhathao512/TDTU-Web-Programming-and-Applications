<?php
if(isset($_FILES['files'])) {
    $rootDirectory = __DIR__ . '/uploads';

    
    foreach ($_FILES['files']['name'] as $key => $name) 
    {
        $tmpFilePath = $_FILES['files']['tmp_name'][$key];
        $newFilePath = $rootDirectory . '/' . $name;
        
        if (!file_exists($newFilePath)) {
            move_uploaded_file($tmpFilePath, $newFilePath);
            echo "File or folder '$name' uploaded successfully.<br>";
        } else {
            echo "Error: File or folder '$name' already exists.<br>";
        }
    }
} else {
    echo "Error: No files uploaded.";
}
?>
