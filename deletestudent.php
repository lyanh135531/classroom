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
    <title>Xóa sinh viên</title>
</head>
<body>
    
    <?php
        require("header.php");
        require("conn.php");
        if (isset($_GET["id"]) && isset($_GET["idclass"]) && isset($_GET["period"])) {
            $id = $_GET["id"];
            $idclass = $_GET["idclass"];
            $period = $_GET["period"];
        }
        if (isset($_POST["confirm-delete-student"])) {
            $sql = "DELETE FROM student_info WHERE id = $id";
            if ($conn->query($sql) == true) {
                header("Location: subject.php?id=$idclass&period=$period");
                exit();
            }    
        }

    ?>
    <div class="delete-class">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h3 class="title-delete-class text-center mb-5"> Xác nhận xóa sinh viên </h3>
                    <?php
                        $sqlstudent = "SELECT * FROM student_info WHERE idclass = $idclass and id = $id";
                        $resultstudent = $conn->query($sqlstudent);
                    ?>
                    <table class="table table-hover table-striped table-bordered text-center" >  
                        <thead>
                            <tr>
                                <th>Mã số sinh viên</th>
                                <th>Họ và chữ lót</th>
                                <th>Tên</th>
                                <th>Email</th>
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
                        </tr>
                        <?php
                            }
                            $conn->close();

                        ?>
                        
                    </table>
                    <form action="#" method="POST">
                        <button type="submit" class="btn btn-danger btn-delete-student-confirm mt-5" name="confirm-delete-student">Xác nhận xóa</button>
                    </form>
                </div>
            </div> 
        </div>
    </div>
</body>
</html>