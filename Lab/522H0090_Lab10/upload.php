<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $allowedExtensions = array("txt", "doc", "docx", "xls", "xlsx", "jpg", "png", "mp3", "mp4", "pdf", "rar", "zip");
    
    $maxFileSize = 500 * 1024 * 1024;
    
    $uploadDirectory = "upload/";
    
    $fileName = $_FILES["document"]["name"];
    $fileSize = $_FILES["document"]["size"];
    $fileTmpName = $_FILES["document"]["tmp_name"];
    $fileType = $_FILES["document"]["type"];
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    
    if (!in_array($fileExtension, $allowedExtensions)) {
        $response = array(
            "success" => false,
            "message" => "Error: This file type is not allowed."
        );
        echo json_encode($response);
        exit();
    } elseif ($fileSize > $maxFileSize) { 
        $response = array(
            "success" => false,
            "message" => "Error: File exceeds the maximum allowed size."
        );
        echo json_encode($response);
        exit();
    } elseif (file_exists($uploadDirectory . $fileName)) { 
        $response = array(
            "success" => false,
            "message" => "Error: This file already exists."
        );
        echo json_encode($response);
        exit();
    } else {
        if (move_uploaded_file($fileTmpName, $uploadDirectory . $fileName)) {
            $response = array(
                "success" => true,
                "message" => "File uploaded successfully.",
                "fileName" => $fileName,
                "fileSize" => $fileSize,
                "fileUrl" => $uploadDirectory . $fileName
            );
            echo json_encode($response);
            exit();
        } else {
            $response = array(
                "success" => false,
                "message" => "Error uploading file."
            );
            echo json_encode($response);
            exit();
        }
    }
}
?>
