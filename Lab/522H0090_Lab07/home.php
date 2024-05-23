<?php
   session_start();
   if(!isset($_SESSION['user'])){
      header('Location: login.php');
      die();
   }
   $user = $_SESSION['user'];

   $root = __DIR__ . '/uploads';
   $dir = '';

   if(isset($_GET['dir'])){
      $dir = $_GET['dir'];
   }
   
   $files = scandir($root . '/'. $dir);
   $files = array_filter($files, function($item){return substr($item,0,1)!=='.';});
?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Bootstrap Example</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <link 
         rel="stylesheet"
         href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
         integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <style>
         .fa, .fas {
         color: #858585;
         }
         .fa-folder {
         color: rgb(74, 158, 255);
         }
         i.fa, table i.fas {
         font-size: 16px;
         margin-right: 6px;
         }
         i.action {
         cursor: pointer;
         }
         a {
         color: black;
         }
      </style>
   </head>
   <body>
      <div class="container">
         <div class="row align-items-center py-5">
            <div class="col-6">
               <h3>File Manager</h3>
            </div>
            <div class="col-6">
               <h5 class="text-right">Xin chào <?php echo $user ?>, <a class="text-primary" href="logout.php">Logout</a></h5>
            </div>
         </div>
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Products</a></li>
            <li class="breadcrumb-item active">Accessories</li>
         </ol>
         <div class="input-group mb-3">
            <div class="input-group-prepend">
               <span class="input-group-text">
               <span class="fa fa-search"></span>         
               </span>
            </div>
            <input type="text" class="form-control" placeholder="Search">
         </div>
         <div class="btn-group my-3">
            <button type="button" class="btn btn-light border" id="new-folder-button">
                <i class="fas fa-folder-plus"></i> New folder
            </button>
            <button type="button" class="btn btn-light border" id="new-file-button">
                <i class="fas fa-file"></i> Create text file
            </button>
         </div>
         <table class="table table-hover border">
            <thead>
               <tr>
                  <th>Name</th>
                  <th>Type</th>
                  <th>Size</th>
                  <th>Last modified</th>
                  <th>Actions</th>
               </tr>
            </thead>
            <tbody>

               <?php
                  foreach($files as $f){
                     $type = 'Folder';
                     $path = $dir .'/' . $f;
                     $full_path = $root .'/' .$path;                     
                     $icon = '<i class="fa fa-folder"></i>';
                     $link = '?dir=' .$path;

                     if(is_file($full_path)){
                        $type = 'File';
                        $icon = '<i class="fa fa-file"></i>';
                        $link = 'http://localhost/522H0090/uploads/'.$path;
                     }


                     ?>
                     <tr>
                        <td>
                           <?=$icon?>
                           <a href="<?= $link?>"><?= $f?></a>
                        </td>
                        <td><?=$type?></td>
                        <td>-</td>
                        <td>02-12-2019</td>
                        <td>
                           <i class="fa fa-download action" onclick="confirmDownload('<?= $f ?>', '<?= $path ?>')"></i>
                           <i class="fa fa-edit action" onclick="confirmRename('<?= $f ?>')"></i>
                           <i class="fa fa-trash action" onclick="confirmDelete('<?= $f ?>')"></i>
                        </td>
                     </tr>
                     <?php
                  }
               ?>

            </tbody>
<?php
   if (isset($_POST['delete'])) {
      $delete_name = $_POST['delete_name'];
      $delete_path = $root . '/' . $dir . '/' . $delete_name;
      if (file_exists($delete_path)) {
         if (is_dir($delete_path)) {
               // Delete directory and its contents recursively
               array_map('unlink', glob("$delete_path/*.*"));
               rmdir($delete_path);
         } else {
               // Delete file
               unlink($delete_path);
         }
      }
   }
?>
<?php
   if (isset($_POST['rename'])) {
      $old_name = $_POST['old_name'];
      $new_name = $_POST['new_name'];
      $old_path = $root . '/' . $dir . '/' . $old_name;
      $new_path = $root . '/' . $dir . '/' . $new_name;
      if (file_exists($old_path)) {
         rename($old_path, $new_path);
      }
   }
?>

      </table>
        <div class="border rounded mb-3 mt-5 p-3">
            <h4>File upload</h4>
            <form id="uploadForm" action="upload.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile" name="files[]" multiple directory webkitdirectory mozdirectory msdirectory odirectory onchange="displaySelectedFiles()">
                        <label class="custom-file-label" for="customFile" id="fileLabel">Choose file(s)</label>            
                    </div>
                </div>
                <p>Người dùng chỉ được upload tập tin có kích thước tối đa là 20 MB.</p>
                <p>Các tập tin thực thi (*.exe, *.msi, *.sh) không được phép upload.</p>
                <p><strong>Yêu cầu nâng cao</strong>: hiển thị progress bar trong quá trình upload.</p>
                <button type="submit" class="btn btn-success px-5">Upload</button>
            </form>
        </div>

        <div id="selectedFilesContainer"></div>

         <div class="modal-example my-5">
            <h4>Một số dialog mẫu</h4>
            <p>Nhấn vào để xem kết quả</p>
             <ul>
                 <li><a href="#" data-toggle="modal" data-target="#confirm-delete">Confirm delete</a></li>
                 <li><a href="#" data-toggle="modal" data-target="#confirm-rename">Confirm rename</a></li>
                 <li><a href="#" data-toggle="modal" data-target="#new-file-dialog">New file dialog</a></li>
                 <li><a href="#" data-toggle="modal" data-target="#message-dialog">Message Dialog</a></li>
             </ul>
         </div>

      </div>

        <!-- message dialog -->
        <!--<div class="modal fade" id="message-dialog">
            <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                <h4 class="modal-title">Xóa file</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
    
                <div class="modal-body">
                    <p>Bạn không được cấp quyền để xóa tập tin/thư mục này</p>
                </div>
            
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Đóng</button>
                </div>            
                </div>
            </div>
            </div>-->

<!--delete-->
<div class="modal fade" id="confirm-delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Xóa tập tin</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="POST" action="">
                <div class="modal-body">
                    <p id="delete-file-name"></p>
                    <input type="hidden" name="delete_name" id="delete-name-input">
                </div>
                <div class="modal-footer">
                    <button type="submit" name="delete" class="btn btn-danger">Xóa</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Không</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>

    function confirmDelete(fileName) {
        $('#delete-file-name').text("Bạn có chắc rằng muốn xóa tập tin " + fileName);
        $('#delete-name-input').val(fileName);
        $('#confirm-delete').modal('show');
    }
</script>

<!--rename-->
<div class="modal fade" id="confirm-rename">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Đổi tên</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="POST" action="">
                <div class="modal-body">
                    <p>Nhập tên mới cho tập tin <strong id="old-file-name"></strong></p>
                    <input type="hidden" name="old_name" id="old-name-input">
                    <input type="text" name="new_name" id="new-name-input" placeholder="Nhập tên mới" class="form-control"/>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="rename" class="btn btn-primary">Lưu</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function confirmRename(oldFileName) {
        $('#old-file-name').text(oldFileName);
        $('#old-name-input').val(oldFileName);
        $('#new-name-input').val('');
        $('#confirm-rename').modal('show');
    }
</script>

<!--dowload-->
<div class="modal fade" id="confirm-download">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tải xuống tập tin</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p id="download-file-name"></p>
                <input type="hidden" name="download_name" id="download-name-input">
            </div>
            <div class="modal-footer">
                <button type="button" id="download-button" class="btn btn-primary">Tải xuống</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDownload(fileName, filePath) {
        $('#download-file-name').text("Bạn có chắc rằng muốn tải xuống " + fileName + "?");
        $('#download-name-input').val(filePath);
        $('#confirm-download').modal('show');

        $('#download-button').click(function() {
            if (fileName.endsWith('/')) {
                window.location.href = 'download.php?dir=' + filePath;
            } else {
                var link = document.createElement('a');
                link.setAttribute('href', filePath);
                link.setAttribute('download', fileName);
                link.click();
                $('#confirm-download').modal('hide');
            }
        });
    }
</script>
<!--create new folder-->
<div class="modal fade" id="new-folder-dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tạo thư mục mới</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="folder-name">Tên thư mục</label>
                    <input name="folder-name" type="text" class="form-control" id="folder-name" placeholder="Nhập tên thư mục">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" >Tạo thư mục</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('new-folder-button').addEventListener('click', function() {
        var folderName = prompt('Enter the name for the new folder:');
        
        if (folderName) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'create.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    alert(xhr.responseText);
                    location.reload();
                } else {
                    alert('Failed to create folder.');
                }
            };
            xhr.send('folder_name=' + encodeURIComponent(folderName));
        }
    });
</script>

<!--Create new file-->
<div class="modal fade" id="new-file-dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="create_file.php" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Create New Text File</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="file-name">File Name</label>
                        <input name="file-name" type="text" class="form-control" id="file-name" placeholder="Enter file name">
                    </div>
                    <div class="form-group">
                        <label for="file-content">File Content</label>
                        <textarea name="file-content" rows="5" class="form-control" id="file-content" placeholder="Enter file content"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Create File</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('new-file-button').addEventListener('click', function() {
        var fileName = prompt('Enter the name for the new text file:');
        
        if (fileName) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'create_file.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    alert(xhr.responseText);
                    location.reload();
                } else {
                    alert('Failed to create text file.');
                }
            };
            xhr.send('file_name=' + encodeURIComponent(fileName));
        }
    });
</script>

<script>
    function displaySelectedFiles() {
    var files = document.getElementById('customFile').files;
    var fileNames = [];
    for (var i = 0; i < files.length; i++) {
        fileNames.push(files[i].name);
    }
    document.getElementById('fileLabel').innerHTML = fileNames.join(', ');
}
</script>

   </body>
</html>