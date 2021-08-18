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
    <title>Trang chủ</title>
</head>
<body>
    <?php
        require("header.php");
        
    ?>
    <div class="home">
        <div class="container">
            <div class="row">
                <?php
                    require("conn.php");
                    if (isset($_GET["search"])) {
                        $search = $_GET["search"];
                        $sql = "SELECT * FROM class_info WHERE subject like '%$search%' or nameclass = '$search'";
                        $result = $conn->query($sql);

                    }
                    else if ($_SESSION["level"] == 1 || $_SESSION["level"] == 2) {
                        $sql = "SELECT * FROM class_info";
                        $result = $conn->query($sql);
                    }
                    else {
                        $owned = $_SESSION["email"];
                        $sql = "SELECT * FROM class_info WHERE owned = '$owned'";
                        $result = $conn->query($sql);
                    }
                    while ($data = $result->fetch_assoc()) {
                ?>
                <div class="col-xl-4 col-lg-4 col-md-6 col-8 col">
                    <div class="cell">
                        <a href="subject.php?id=<?php echo $data["id"]?>&period=<?=$data["period"]?>">
                        <div class="class-info p-2">
                            <div class="class-info-teacher">
                                <div class="class-name"><?php echo $data["nameclass"]."_".$data["subject"] ?></div>
                            </div>
                            <div class="teacher-name"><?php echo $data["room"]."_".$data["period"] ?> tiết</div>
                        </div>
                        <div class="class-content">
                            <img class="teacher-img" src="<?php echo $data["imgteacher"]?>">
                        </div>
                        <div class="class-edit">
                            <a class="delete btn btn-danger float-right" href="deleteclass.php?id=<?php echo $data["id"] ?>">Xóa</a>
                            <a class="edit btn btn-info float-right" href="createclass.php?id=<?php echo $data["id"] ?>">Sửa</a>
                        </div>
                        </a>
                    </div>
                </div>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>