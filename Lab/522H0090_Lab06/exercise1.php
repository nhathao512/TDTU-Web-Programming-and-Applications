<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bảng cửu chương</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    .table {
      font-family: 'Times New Roman', Times, serif;
    }
  </style>
</head>
<body>

<div class="container">     
  <table class="table table-bordered mt-5 text-center">
    <thead>
      <tr>
        <th colspan="10" class="bg-secondary">BẢNG CỬU CHƯƠNG</th>    
      </tr>
    </thead>
    <tbody>
      <?php
          for ($i = 1; $i <= 10; $i++)
          {
              echo "<tr>";
              for ($j = 1; $j <= 10; $j++){
                  $c = $i * $j;
                  echo"<td>$j x $i = $c</td>";
              }
              echo "</tr>";
          } 
          ?>
      </tbody>
  </table>
</div>

</body>
</html>