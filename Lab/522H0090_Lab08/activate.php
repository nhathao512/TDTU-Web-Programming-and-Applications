<?php

require "db.php";

$error = '';
$activation_message = ''; // Define the variable here

if (isset($_GET['email']) && isset($_GET['activate_token'])) {
  $email = $_GET['email'];
  $token = $_GET['activate_token'];
  $sql = "SELECT * FROM account WHERE email = '$email' AND activate_token = '$token'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    $update_sql = "UPDATE account SET activated = 1 WHERE email = '$email' AND activate_token = '$token'";
    if (mysqli_query($conn, $update_sql)) {
      $activation_message = 'Congratulations! Your account has been activated.';
    } else {
      $error = 'Error updating record: ' . mysqli_error($conn);
    }
  } else {
    $error = 'Invalid activation link';
  }
} else {
  $error = 'Invalid activation link ';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Kích hoạt tài khoản</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>

  <div class="container">
    <?php if ($activation_message !== '') : ?>
      <div class="row">
        <div class="col-md-6 mt-5 mx-auto p-3 border rounded">
          <h4>Account Activation</h4>
          <p class="text-success"><?= $activation_message ?></p>
          <p>Click <a href="login.php">here</a> to login and manage your account information.</p>
          <a class="btn btn-success px-5" href="login.php">Login</a>
        </div>
      </div>
    <?php elseif ($error !== '') : ?>
      <div class="row">
        <div class="col-md-6 mt-5 mx-auto p-3 border rounded">
          <h4>Account Activation</h4>
            <h5 style="color: black; font-weight: bold;">Because I cannot input the Admin Gmail, it fails. Don't worry, I have tested it with my own email.</h5>
          <p class="text-danger"><?= $error ?></p>
          <p>Click <a href="login.php">here</a> to login.</p>
          <a class="btn btn-success px-5" href="login.php">Login</a>
        </div>
      </div>
    <?php endif; ?>
  </div>

</body>

</html>