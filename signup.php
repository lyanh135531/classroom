<?php
    session_start();
    if (isset($_SESSION["email"])) {
        header('Location: index.php');
        exit();
    }

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
    <title>Đăng ký</title>
</head>
<body>
    <?php
        $alert = "";
        $error = "";
        $name = "";
        $email = "";
        $password = "";
        $faculty = "";
        $phone = "";
        
        if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["faculty"]) && isset($_POST["phone"])) {
            $name = $_POST["name"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $faculty = $_POST["faculty"];
            $phone = $_POST["phone"];
            $hash = md5($password);

            require_once("isemailexist.php");

            if ($result->num_rows > 0) {
                $error = "Email đã tồn tại";
            }
            else {
                require("conn.php");
                $sql = "INSERT INTO user_info (name, email, password, faculty, phone)
                VALUES ('$name', '$email', '$hash', '$faculty', '$phone')";

                if ($conn->query($sql) === TRUE) {
                    $alert = "Tạo tài khoản thành công!";
                } 

                $conn->close();
            }
            
                
        }
    ?>
    <div class="signup">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-10 col-md-7 col-xl-5">
                    <h1 class="login-heading text-center text-light pt-md-4">Đăng Ký</h1>
                    <div class="signup-form p-3">
                        <form action="signup.php" method="POST">
                            <div class="form-group">
                                <?php
                                    if (!empty($alert)) {
                                        echo '<div class="alert alert-success text-center">' . $alert . '</div>';
                                    }
                                ?>
                                <label class="text-light" for="name">Họ và Tên</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-user"></i></span>
                                    <input id="name" type="text" class="form-control" placeholder="Họ và Tên" name="name" aria-describedby="addon-wrapping" value=<?=$name?>>
                                </div>
                                <div id="error" class="errorName mt-3 text-danger"></div>
                            </div>
    
                            <div class="form-group pt-md-2">
                                <label class="text-light" for="email">Email</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-envelope"></i></span>
                                    <input id="email" type="text" class="form-control" placeholder="name@gmail.com" name="email" aria-describedby="addon-wrapping" value=<?=$email?>>
                                </div>
                                <div id="error" class="errorEmail mt-3 text-danger"></div>
                                
                            <div>
    
                            <div class="form-group pt-md-2">
                                <label class="text-light" for="pass">Mật khẩu</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-lock"></i></span>
                                    <input id="pass" type="password" class="form-control" placeholder="Mật khẩu" name="password" aria-describedby="addon-wrapping" value=<?=$password?>>
                                </div>
                                <div id="error" class="errorPass mt-3 text-danger"></div>
                            <div>
    
                            <div class="row">
                                <div class="col-md-6 pt-md-2">
                                    <label class="text-light" for="faculty">Khoa</label>
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="addon-wrapping"><i class="fas fa-book"></i></span>
                                        <input id="faculty" type="text" class="form-control" placeholder="Khoa" name="faculty" aria-describedby="addon-wrapping" value=<?=$faculty?>>
                                    </div>
                                    <div id="error" class="errorFaculty mt-3 text-danger"></div>
                                </div>
                                <div class="col-md-6 pt-md-2">
                                    <label class="text-light" for="phone">Số điện thoại</label>
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="addon-wrapping"><i class="fas fa-phone"></i></span>
                                        <input id="phone" type="text" class="form-control" placeholder="Số điện thoại" name="phone" aria-describedby="addon-wrapping" value=<?=$phone?>>
                                    </div>
                                    <div id="error" class="errorPhone mt-3 text-danger"></div>
                                </div>
                            </div>
    
                            <div class="form-group pt-md-4">
                                <?php
                                    if (!empty($error)) {
                                        echo '<div class="alert alert-danger">' . $error . '</div>';
                                    }
                                    

                                ?>
                                <input type="submit" class="contactform-buttons bg-success text-light" id="signup-submit" value="Đăng Ký"/>
                                <p class="text-center text-light">Bạn đã có tài khoản? <a href="signin.php">Đăng nhập</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>