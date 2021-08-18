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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="main.js"></script>
    <title>Thêm sinh viên</title>
</head>
<body>
    <?php
        require("header.php");
        require("conn.php");
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
        }
        $mssv = "";
        $surname = "";
        $name = "";
        $email = "";
        $alert = "";
        if (isset($_POST["mssv"]) && isset($_POST["surname"]) && isset($_POST["name"]) && isset($_POST["email"])) {
            $mssv = $_POST["mssv"];
            $surname = $_POST["surname"];
            $name = $_POST["name"];
            $email = $_POST["email"];

            $sqlcheckmail = "SELECT * FROM student_info WHERE email = '$email'";
            $resultcheckmail  = $conn->query($sqlcheckmail);
            if (!($resultcheckmail->num_rows>0)) {
                $sql = "INSERT INTO student_info (mssv, surname, name, email, idclass)
                VALUES ('$mssv', '$surname', '$name', '$email', '$id')";
                $conn->query($sql);
                header("Location:  subject.php?id=$id");
                exit();
            }
            else {
                $alert = "Email đã tồn tại";
            }
        }
        $conn->close();
    ?>

    <div class="create-student">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-sm-10">
                    <h3 class="title-create-student text-center"> Thông tin sinh viên </h3>
                    <form action="#" method="POST">
                        <div class="information-student border rounded p-4 mt-4">
                            <div class="form-group">
                                <label class="infor-create-student" for="mssv">Mã số sinh viên</label>
                                <input id="mssv" type="text" class="form-control p-4" placeholder="Mã số sinh viên" name="mssv">
                                <div id="error" class="errormssv my-3 text-danger"></div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="infor-create-student" for="surname">Họ và chữ lót</label>
                                        <input id="surname" type="text" class="form-control p-4" placeholder="Họ và chữ lót" name="surname">
                                        <div id="error" class="errorsurname my-3 text-danger"></div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="infor-create-student" for="name">Tên</label>
                                        <input id="name" type="text" class="form-control p-4" placeholder="Tên" name="name">
                                        <div id="error" class="errorname my-3 text-danger"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="infor-create-student" for="email">Email</label>
                                <input id="email" type="email" class="form-control p-4" placeholder="Email" name="email">
                                <div id="error" class="erroremail my-3 text-danger"></div>
                            </div>
                        </div>
                            <?php
                                if (!empty($alert)) {
                                    echo '<div class="alert alert-danger mt-3">' . $alert . '</div>';
                                }

                            ?>
                            <div class="form-group">
                                <input type="submit" class="btn btn-success btn-create-student-submit my-4" id="create-student-submit" value="Thêm sinh viên"/>
                            </div>
                    </form>
                </div>
            </div> 
        </div>
    </div>
</body>
</html>