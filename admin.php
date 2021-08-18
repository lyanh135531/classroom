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
    <title>Phân quyền</title>
</head>
<body>
    <?php
        require("header.php");

        if (isset($_GET["id"]) && isset($_GET["level"])) {
            $level = $_GET["level"];
            $id = $_GET["id"];
            require("conn.php");
            if ($level == 1) {
                $sql = "UPDATE user_info SET level = 0 WHERE id = $id";
                $conn->query($sql);
            }
            else if ($level == 0) {
                $sql = "UPDATE user_info SET level = 1 WHERE id = $id";
                $conn->query($sql);
            }
            $conn->close();
        }
    ?>
    <div class="admin">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1 class="title-admin text-center mb-4">Phân quyền</h1>
                    <table class="table table-hover table-striped table-bordered text-center" >  
                        <thead>
                            <tr>
                                <th>Họ và Tên</th>
                                <th>Email</th>
                                <th>Khoa</th>
                                <th>Số điện thoại</th>
                                <th>Quyền</th>
                                <th>Phân quyền</th>
                            </tr>
                        </thead>
                        <?php
                            require("conn.php");
                            $sql = "SELECT * FROM user_info";
                            $result = $conn->query($sql);
                            while ($data = $result->fetch_assoc()) {
                        ?>
    
                        <tr class="item">
                            <td class=" align-middle"><?php echo $data["name"] ?></td>
                            <td class=" align-middle"><?php echo $data["email"] ?></td>
                            <td class=" align-middle"><?php echo $data["faculty"] ?></td>
                            <td class=" align-middle"><?php echo $data["phone"] ?></td>
                            <td class=" align-middle"><?php if($data["level"]==0){echo "Giáo viên";}else{echo "Admin";} ?></td>
                            <td class=" align-middle"><a href="admin.php?id=<?php echo $data["id"] ?>&level=<?php echo $data["level"] ?>" class="btn btn-success"><?php if($data["level"]==0){echo "Admin";}else if ($data["level"]==1){echo "Giáo viên";}else{echo "Admin";} ?></a></td>
                        </tr>
                        <?php
                            }
                        ?>
                    </table>
                </div>
            </div>
            <div class="text-right">
                Tổng cộng có <span class="badge badge-danger badge-pill"><?php echo $result->num_rows ?></span> tài khoản
            </div>
        </div>
    </div>

    <!-- Delete Confirm Modal
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog"> -->

            <!-- Modal content-->
            <!-- <div class="modal-content">
                <div class="modal-header">
                    <hp class="modal-title">Xóa sản phẩm</hp>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc rằng muốn xóa <strong>iPhone XS MAX</strong> ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger">Xóa</button>
                </div>

            </div>

        </div>
    </div> -->
    

</body>
</html>