<?php

    require("conn.php");

    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    $hashed_password = md5($password);

    $sql = "SELECT * FROM user_info where email = ? and password = ?";
    $stm = $conn->prepare($sql);
    $stm->bind_param("ss",$email,$hashed_password);
    if (!$stm->execute()) {
        die('Query error: ' . $stm->error);
    }

    $result = $stm->get_result();

    $data = $result->fetch_assoc();

    $conn->close();

?>