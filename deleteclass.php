<?php
    session_start();
    if (!isset($_SESSION["email"])) {
        header('Location: signin.php');
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
    <title>Xóa lớp</title>
</head>
<body>
    <?php
        require("header.php");
        if ($_GET["id"]) {
            $id = $_GET["id"];
        }

        $alert = "";
        if (isset($_POST["password"])) {
            $password = $_POST["password"];
            if (md5($password) == $_SESSION["password"]) {
                $sql = "DELETE FROM class_info WHERE id = $id";
                require("conn.php");
                $conn->query($sql);
                $conn->close();
                header("Location: home.php");
                exit();
            }
            else if ($password == "") {
                $alert = "Vui lòng nhập mật khẩu";
            }
            else {
                $alert = "Sai mật khẩu vui lòng nhập lại";
            }
        }
    ?>
    <div class="delete-class">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-sm-10">
                    <h3 class="title-delete-class text-center"> Xác nhận xóa lớp học </h3>
                    <form action="#" method="post">
                        <div class="information-delete-class border rounded p-4 mt-4">
                            <div class="form-group">
                                <label class="infor-create-class" for="nameclass">Nhập mật khẩu</label>
                                <input id="password" type="password" class="form-control p-4" placeholder="Mật khẩu" name="password">
                                <?php
                                    if (!empty($alert)) {
                                        echo '<div class="errorPass mt-3 text-danger">' . $alert . '</div>';
                                    }

                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success btn-delete-class my-4" id="delete-class-submit" value="Xác nhận xóa lớp"/>
                        </div>
                    </form>
                </div>
            </div> 
        </div>
    </div>
</body>
</html>