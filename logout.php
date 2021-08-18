<?php
    session_start();
    session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <script src="main.js"></script>
  <title>Đăng nhập</title>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-6 mt-5 mx-auto p-3 border rounded">
          <h4>Đăng xuất thành công</h4>
          <p>Tài khoản của bạn đã được đăng xuất khỏi hệ thống.</p>
          <a class="btn btn-success px-5" href="signin.php">Đăng nhập</a>
      </div>
    </div>
  </div>
</body>
</html>
