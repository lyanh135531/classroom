<?php
    session_start();
    if (isset($_SESSION["email"])) {
        header('Location: home.php');
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
    <title>Đăng nhập</title>
</head>
<body>
    <?php
        error_reporting(0);
        $error = "";

        if (isset($_COOKIE["email"]) && isset($_COOKIE["password"])) {
            $email = $_COOKIE["email"];
            $password = $_COOKIE["password"];
        }
        else {
            $email = "";
            $password = "";
        }
        if (isset($_POST["email"]) && isset($_POST["password"])) {
            $email = $_POST["email"];
            $password = $_POST["password"];

            require_once("processsignin.php");
            
            if ($result->num_rows>0) {

                if(isset($_POST["remember"])) {
    
                    setcookie("email", $email, time() + 86400 * 30);
                    setcookie("password", $password, time() + 86400 * 30);
                }
                
                $_SESSION["email"] = $email;
                $_SESSION["password"] = $data["password"];
                $_SESSION["name"] = $data["name"];
                $_SESSION["level"] = $data["level"];
                
                header("Location: home.php");
                exit();
            }
            else {
                $error = "Email hoặc mật khẩu không đúng";
            }
        }
    ?>
    <div class="signin">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-10 col-md-7 col-xl-5">
                    <h1 class="login-heading text-center text-light pt-4">Đăng nhập</h1>
                    <div class="login-form p-3">
                        <form action="signin.php" method="POST">
                            <div class="form-group">
                                <label class="text-light" for="email">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-envelope"></i></span>
    
                                    <input id="email" type="email" class="form-control" placeholder="name@gmail.com" name="email" aria-describedby="addon-wrapping" value="<?= $email ?>">
                                </div>
                                <div id="error" class="errorEmail mt-3 text-danger"></div>
                            </div>
    
                            <div class="form-group pt-2">
                                <label class="text-light" for="pass">Mật khẩu</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-lock"></i></span>
                                    <input id="pass" type="password" class="form-control" placeholder="Mật khẩu" name="password" aria-describedby="addon-wrapping" value="<?= $password ?>">
                                </div>
                                <div id="error" class="errorPass mt-3 text-danger"></div>
                            <div>
    
                            <div class="row pass-check">
                                <div class="col-md-6 text-light">
                                    <input <?php isset($_POST['remember'])!=0 ?1:"" ?> type="checkbox" name="remember" id="checkbox" value="1">Nhớ mật khẩu
                                </div>
                                <div class="col-md-6">
                                    <p class="text-right"><a href="forgotemail.html">Quên mật khẩu</a></p>
                                    
                                </div>
                            </div>
                            
                            <div class="form-group pt-2">
                                <?php
                                    if (!empty($error)) {
                                        echo '<div class="alert alert-danger">' . $error . '</div>';
                                    }

                                ?>
                                <input type="submit" class="contactform-buttons bg-success text-light" id="signin-submit" value="Đăng Nhập"/>
                                <p class="text-center text-light">Bạn chưa có tài khoản? <a href="signup.php">Đăng ký</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>