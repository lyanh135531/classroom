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
</head>
<body>
    <?php
        require("header.php");
        require("conn.php");

        if (isset($_GET["id"]) && isset($_GET["period"])) {
            $id = $_GET["id"];
            $period = $_GET["period"];
        }

        $content = "";
        if (isset($_POST["createlesson"])) {
            $content = $_POST["createlesson"];

            $sql = "INSERT INTO lesson_info (content, idclass) VALUES ('$content','$id')";
            $conn->query($sql);

        }

        $notify = "";
        if (isset($_POST["notify"])) {
            $notify = $_POST["notify"];
            $sql = "INSERT INTO notify_info (content, idclass)
            VALUES ('$notify', '$id')";

            $conn->query($sql);

        }
        
        if (isset($_POST["import"])) {
            $fileimport =  $_FILES["importstudent"]["tmp_name"];
            if ($_FILES["importstudent"]["size"] > 0) {
                $file = fopen($fileimport,"r");
                while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
                    $mssv = "";
                    if (isset($column[0])) {
                        $mssv = $column[0];
                    }
                    $surname = "";
                    if (isset($column[1])) {
                        $surname = $column[1];
                    }
                    $name = "";
                    if (isset($column[2])) {
                        $name = $column[2];
                    }
                    $email = "";
                    if (isset($column[3])) {
                        $email = $column[3];
                    }
                    $sqlcheckmail = "SELECT * FROM student_info WHERE email = '$email'";
                    $resultcheckmail  = $conn->query($sqlcheckmail);
                    if (!($resultcheckmail->num_rows>0)) {
                        $sql = "INSERT INTO student_info (mssv, surname, name, email, idclass)
                        VALUES ('$mssv', '$surname', '$name', '$email', '$id')";
                        $conn->query($sql);
                    }
                    
                }
            }
        }
        

        
    ?>
    <div class="subject-page">
        <div class="container">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#homesubject">Bảng tin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#people">Mọi người</a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="homesubject" class="container tab-pane active"><br>
                    <?php
                        $sqlstudent = "SELECT * FROM student_info WHERE idclass = $id";
                        $resultstudent = $conn->query($sqlstudent);
                        $sqlclass = "SELECT * FROM class_info WHERE id = $id";
                        $resultclass = $conn->query($sqlclass);
                        while ($data = $resultclass->fetch_assoc()) {
                    ?>
                    <title><?php echo $data["subject"] ?></title>

                    <div class="row">
                        <div class="col">
                            <div class="subject-info p-4 mb-4">
                                <div class="title-subject"><?php echo $data["nameclass"]."_".$data["subject"] ?></div>
                                <div class="subtitle-subject"><?php echo $data["room"]."_".$data["period"] ?> tiết</div>
                                <div class="total-people"><?=$resultstudent->num_rows?> sinh viên</div>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                                          
                    ?>
        
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="notification-info border mb-4">
                                <div class="notification font-weight-bold">Thông báo <a href="deletenotify.php?id=<?=$id?>&period=<?$period?>" class="float-right">Xóa tất cả</a></div>

                                <?php
                                    $sqlnotify = "SELECT * FROM notify_info WHERE idclass = $id";
                                    $resultnotify = $conn->query($sqlnotify);
                                    while ($data = $resultnotify->fetch_assoc()) { 
                                ?>
                                <div class="notification-content ml-3 mt-3"><?php if($resultnotify->num_rows>0){echo $data["content"];}else{echo "Hiện tại không có thông báo";} ?></div>
                                <?php
                                    }

                                ?>
                                <div class="form-group pt-3">
                                    <form action="#" method="POST">
                                        <input id="notify" type="text" class="form-control d-inline" placeholder="Nội dung" name="notify">
                                        <input type="submit" name="upnotify" class="submit-notify-btn btn btn-secondary text-light float-right mt-3" id="notify-submit" value="Đăng"/>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="create-lesson border">
                                <form action="#" method="POST">
                                    <div class="form-group">
                                        <label for="createlesson" class="font-weight-bold">Tạo buổi học</label>
                                        <input id="create-lesson" type="text" class="form-control py-4" placeholder="Nội dung buổi học" name="createlesson">
                                        <input type="submit" name="btncreatelesson" class="create-lesson-btn btn btn-success text-light mt-4 float-right" id="createlesson-submit" value="Đăng"/>
                                    </div>
                                </form>
                            </div>
                            <?php
                                $sqllesson = "SELECT * FROM lesson_info WHERE idclass = $id";
                                $resultlesson = $conn->query($sqllesson);
                                while ($data = $resultlesson->fetch_assoc()) { 
                            ?>
                            <div class="lesson-content mt-4">

                                <div class="lesson-info border">

                                    <a href="attendance.php?id=<?=$data["id"]?>&idclass=<?=$id?>" class="title-lesson text-dark"><div class="lesson-notify card-header">
                                        <i class="fas fa-tasks border p-2 mr-3"></i><?php echo $_SESSION["name"] ?> đã đăng một nội dung mới:</div><a class="delete-lesson" href="deletelesson.php?idlesson=<?=$data["id"]?>&id=<?=$id?>&period=<?=$period?>">Xóa</a></a>
                                    
                                    <div class="card-body">
                                    
                                        <div><?php echo $data["content"] ?></div>
                                    </div>
                                </div>
                            </div>

                            <?php
                                }
                                
                            ?>
                        </div>
                    </div>

                    
                </div>
                <div id="people" class="container tab-pane fade"><br>
                    <div class="row justify-content-center">
                        <div class="col-3"></div>
                        <div class="col-md-6">
                            <div class="people-teacher">
                                <div class="people-teacher-title text-center"> Giáo viên </div>
                                <div class="people-teacher-name text-center border"><?php echo $_SESSION["name"] ?></div>
                            </div>
                        </div>
                        <div class="col-3"></div>
                        <div class="col-12">
                            <div class="studentstatistic">
                                <div class="people-student-statistic-title text-center mt-5 text-danger">Sinh viên vắng quá 20% số buổi</div>
                                
                                <table class="table table-hover table-striped table-bordered text-center" >  
                                    <thead>
                                        <tr>
                                            <th>Mã số sinh viên</th>
                                            <th>Họ và chữ lót</th>
                                            <th>Tên</th>
                                            <th>Email</th>
                                            <th>Số buổi vắng</th>
                                        </tr>
                                    </thead>
                                    <?php
                                        $sqlstatistic = "SELECT * FROM attendance_info WHERE idclass = $id";
                                        $resultstatistic = $conn->query($sqlstatistic);
                                        while ($data = $resultstatistic->fetch_assoc()) {
                                            $idstudent = $data["idstudent"];
                                            $absent = $data["absent"];
                                            if ($absent > $period/3*20/100) {
                                                $sql = "SELECT * FROM student_info WHERE id = $idstudent";
                                                $result = $conn->query($sql);
                                            }
                                    
                                            while ($datastudent = $result->fetch_assoc()) { 
                                    ?>
                                    <tr class="item">
                                        <td class=" align-middle"><?php echo $datastudent["mssv"] ?></td>
                                        <td class=" align-middle"><?php echo $datastudent["surname"] ?></td>
                                        <td class=" align-middle"><?php echo $datastudent["name"] ?></td>
                                        <td class=" align-middle"><?php echo $datastudent["email"] ?></td>
                                        <td class=" align-middle"><?php echo $data["absent"] ?></td>
                                    </tr>
                                    <?php
                                            }
                                        }
                                    ?>
                                    
                                </table>
                                
                            </div>
                        </div>
                        </div>
                            <div class="people-student mt-5">
                                
                                <div class="people-student-title text-center">Sinh viên (<?php echo $resultstudent->num_rows ?> sinh viên)</div>
                                <table class="table table-hover table-striped table-bordered text-center" >  
                                    <thead>
                                        <tr>
                                            <th>Mã số sinh viên</th>
                                            <th>Họ và chữ lót</th>
                                            <th>Tên</th>
                                            <th>Email</th>
                                            <th>Xóa</th>
                                        </tr>
                                    </thead>
                                    <?php
                                        
                                        while ($data = $resultstudent->fetch_assoc()) { 
                                    ?>
                                    <tr class="item">
                                        <td class=" align-middle"><?php echo $data["mssv"] ?></td>
                                        <td class=" align-middle"><?php echo $data["surname"] ?></td>
                                        <td class=" align-middle"><?php echo $data["name"] ?></td>
                                        <td class=" align-middle"><?php echo $data["email"] ?></td>
                                        <td class=" align-middle"><a href="deletestudent.php?id=<?=$data["id"]?>&idclass=<?=$id?>&period=<?=$period?>">Xóa</a></td>
                                    </tr>
                                    <?php
                                        }
                                        $conn->close();

                                    ?>
                                    
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="people-create-student-title text-center mt-5">Thêm sinh viên</div>
                                </div>
                                <div class="col-6">
                                    <div class="import-student border my-5">
                                        <div class="label-import mb-3 font-weight-bold text-center">Import từ file</div>
                                        <form action="#" method="POST" enctype="multipart/form-data">
                                            <input type="file" name="importstudent" id="importstudent">
                                            <input type="submit" name="import" class="btn btn-success float-right mr-3 mt-1 px-4" value="Thêm">
                                        </form>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="create-student border p-3 my-5">
                                        <div class="label-create-student mb-3 font-weight-bold text-center">Thêm sinh viên thủ công</div>
                                        <a href="createstudent.php?id=<?php echo $id ?>" class="btn btn-success btn-create-student">Thêm sinh viên</a>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>     
            </div>       
        </div>
    </div>
    
</body>
</html>