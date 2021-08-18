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
    <title>Điểm danh</title>
</head>
<body>
    <?php
        require("header.php");
        require("conn.php");
        if (isset($_GET["id"]) && isset($_GET["idclass"])) {
            $id = $_GET["id"];
            $idclass = $_GET["idclass"];
        }

        $comment= "";
        if (isset($_POST["comment"])) {
            $comment = $_POST["comment"];
            $sql = "INSERT INTO comment_info (content, idlesson)
            VALUES ('$comment', '$id')";

            $conn->query($sql);
        }

        if (isset($_POST["checkstudent"])) {
            foreach ($_POST["checkstudent"] as $idstudent) {
                $sqlcheck = "SELECT * FROM attendance_info WHERE idstudent = $idstudent";
                $resultcheck = $conn->query($sqlcheck);
                if ($resultcheck->num_rows>0) {
                    while ($datacheck = $resultcheck->fetch_assoc()) {
                        $absent = $datacheck["absent"];
                        $sql = "UPDATE attendance_info SET idstudent='$idstudent', idclass='$idclass', absent=$absent+1 WHERE idstudent=$idstudent";
                        $conn->query($sql);
                    }
                }
                else {
                    $sql = "INSERT INTO attendance_info (idstudent, idclass, absent)
                    VALUES ('$idstudent', '$idclass', 1)";
                    $conn->query($sql);
                }

            }
        }

    ?>

    <div class="attendance">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-8">
                    <div class="border rounded">
                        <?php
                            $sqllesson = "SELECT * FROM lesson_info WHERE id = $id";
                            $resultlesson = $conn->query($sqllesson);
                            while ($data = $resultlesson->fetch_assoc()) { 
                        ?>
                        <div class="card-header"><?php echo $_SESSION["name"] ?> đã đăng một nội dung mới:</div>
                        <div class="card-body">
                            <div><?php echo $data["content"] ?></div>
                        </div>
                        <div class="card-footer pt-4">
                            <div class="cmt-info">
                                <div class="font-weight-bold mb-3">Bình luận</div>
                        <?php 
                            }
                            $sqlcmt = "SELECT * FROM comment_info WHERE idlesson = $id";
                            $resultcmt = $conn->query($sqlcmt);
                            while ($data = $resultcmt->fetch_assoc()) { 
                        ?>
                            <div class="cmt pb-4">- <?php echo $_SESSION["name"] ?>: <?php echo $data["content"] ?></div>
                        <?php
                            }
                        ?>
                            </div>
                            <form action="#" method="POST">
                                <div class="form-group">
                                    <input type="text" class="form-control comment" placeholder="Bình luận" name="comment">
                                    <input type="submit" class="btn-comment btn btn-success float-right px-4" value="Đăng">
                                </div>
                            </form>
                        </div>
                        
                    </div>
                </div>
                <div class="col-12">
                    <form action="#" method="POST">   
                        <div class="people-student-title text-center mt-4">Điểm danh</div>
                        <table class="table table-hover table-striped table-bordered text-center" > 
                            <thead>
                                <tr>
                                    <th>Mã số sinh viên</th>
                                    <th>Họ và chữ lót</th>
                                    <th>Tên</th>
                                    <th>Email</th>
                                    <th>Vắng mặt</th>
                                </tr>
                            </thead>
                            
                            <?php
                                $sqlstudent = "SELECT * FROM student_info WHERE idclass = $idclass";
                                $resultstudent = $conn->query($sqlstudent);
                                while ($data = $resultstudent->fetch_assoc()) { 
                            ?>
                            <tr class="item">
                                <td class=" align-middle"><?php echo $data["mssv"] ?></td>
                                <td class=" align-middle"><?php echo $data["surname"] ?></td>
                                <td class=" align-middle"><?php echo $data["name"] ?></td>
                                <td class=" align-middle"><?php echo $data["email"] ?></td>
                                <td class=" align-middle"><input value=<?=$data["id"]?> type="checkbox" class="form-check-input-student" name="checkstudent[]"></td>
                            </tr>
                            <?php
                                }
                                $conn->close();
                                

                            ?>
                            
                        </table>
                        <div><button type="submit" name="checkattendance" class="btn btn-success mb-5 px-5">Save</button></div>
                    </form>
                </div>
            </div> 
        </div>
    </div>
</body>
</html>