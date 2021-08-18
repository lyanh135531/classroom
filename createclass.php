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
    <title>Tạo/Cập nhật lớp</title>
</head>
<body>
    <?php
        require("header.php");
        $alert = "";
        $nameclass = "";
        $subject = "";
        $room = "";
        $period = "";
        if (isset($_POST["nameclass"]) && isset($_POST["subject"]) && isset($_POST["room"]) && isset($_POST["period"])) {
            $nameclass = $_POST["nameclass"];
            $subject = $_POST["subject"];
            $room = $_POST["room"];
            $period = $_POST["period"];
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["img-teacher"]["name"]);
            move_uploaded_file($_FILES["img-teacher"]["tmp_name"], $target_file);
            $owned = $_SESSION["email"];
            
            require("conn.php");
            if (isset($_GET["id"])) {
                $id = $_GET["id"];
                $sql = "UPDATE class_info SET nameclass='$nameclass', subject='$subject', room='$room', period=$period, imgteacher='$target_file' WHERE id=$id";
                if ($conn->query($sql) === TRUE) {
                    header(("Location: home.php"));
                    exit();
                } 
            }
            else {
                $sql = "INSERT INTO class_info (nameclass, subject, room, period, imgteacher, owned)
                VALUES ('$nameclass', '$subject', '$room', $period, '$target_file', '$owned')";
    
                if ($conn->query($sql) === TRUE) {
                    header(("Location: home.php"));
                    exit();
                } 
            }

            $conn->close();
        }
    ?>
    <div class="create-class">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-sm-10">
                    <h3 class="title-create-class text-center"> Thông tin lớp học </h3>
                    <?php
                        if (!empty($alert)) {
                            echo '<div class="alert alert-success text-center">' . $alert . '</div>';
                        }
                    ?>
                    <form action="#" method="POST" enctype="multipart/form-data">
                        <div class="information-class border rounded p-4 mt-4">
                            <div class="form-group">
                                <label class="infor-create-class" for="nameclass">Tên lớp học</label>
                                <input id="nameclass" type="text" class="form-control p-4" placeholder="Tên lớp học" name="nameclass">
                                <div id="error" class="errornameclass my-3 text-danger"></div>
                            </div>
                            <div class="form-group">
                                <label class="infor-create-class" for="subject">Môn học</label>
                                <input id="subject" type="text" class="form-control p-4" placeholder="Môn học" name="subject">
                                <div id="error" class="errorsubject my-3 text-danger"></div>
                            </div>
                                
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="infor-create-class" for="room">Phòng học</label>
                                        <input id="room" type="text" class="form-control p-4" placeholder="Phòng học" name="room">
                                        <div id="error" class="errorroom my-3 text-danger"></div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="infor-create-class" for="period">Tổng số tiết</label>
                                        <input id="period" type="number" class="form-control p-4" placeholder="Tổng số tiết" name="period">
                                        <div id="error" class="errorperiod my-3 text-danger"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="infor-create-class" for="img-teacher">Hình ảnh đại diện</label><br>
                                <input type="file" name="img-teacher" id="imgteacher">
                            </div>
                        </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-success btn-create-class my-4" id="create-class-submit" value="Tạo lớp"/>
                            </div>
                    </form>
                </div>
            </div> 
        </div>
    </div>
</body>
</html>