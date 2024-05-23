<?php
   if (isset($_POST['download_name'])) {
      $filename = $_POST['download_name'];
      
      if (preg_match('/^[a-zA-Z0-9_\-.]+$/', $filename)) {
         $filepath = __DIR__ . '/uploads/' . $filename;
         
         if (file_exists($filepath)) {
               header('Content-Type: application/octet-stream');
               header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
               header('Content-Length: ' . filesize($filepath));

               readfile($filepath);
               exit;
         } else {
               echo 'File not found';
         }
      } else {
         echo 'Invalid filename';
      }
   } else {
      echo 'Filename not provided';
   }
?>
