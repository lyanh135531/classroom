<nav class="navbar bg-dark navbar-dark fixed-top">
        <div class="form-inline">
            <a class="navbar-brand" href="home.php" title="Trang chủ">Classroom</a>
            <div class="name-user text-light">Xin chào <?= $_SESSION["name"]?></div>
            <a class="btn btn-sm btn-secondary ml-3 p-2" href="logout.php">Đăng xuất</a>
        </div>
        <form class="form-inline" action="home.php" method="GET">
            <?php
                if ($_SESSION["level"] == 1 || $_SESSION["level"] == 2) {
                    echo '<a class="btn btn-sm btn-warning mr-3 p-2" href="admin.php">Phân quyền</a>';
                }

            ?>
            
            <span class="create-icon pr-3"><a class="fas fa-plus" href="createclass.php" title="Tạo lớp học"></a></span>
            <input class="form-control mr-sm-2" type="text" placeholder="Tìm lớp học..." name="search" value="<?php if(isset($_GET["search"])){echo $_GET["search"];}else{echo "";} ?>">
            <input type="submit" class="btn btn-success" value="Tìm kiếm">
            <button class="navbar-toggler ml-3" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon" title="Danh sách lớp"></span>
            </button>
        </form> 
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <?php
                    require("conn.php");
                    $sql = "SELECT * FROM class_info";
                    $result = $conn->query($sql);
                    while ($data = $result->fetch_assoc()) {
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="#"><?php echo $data["nameclass"]."_".$data["subject"] ?></a>
                </li> 
                <?php
                    }
                ?>
            </ul>
        </div>
    </nav>
    <br>