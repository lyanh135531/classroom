<?php
    require("conn.php");
    $sql = "SELECT email FROM user_info where email = ?";
    $stm = $conn->prepare($sql);
    $stm->bind_param("s",$email);
    if (!$stm->execute()) {
        die('Query error: ' . $stm->error);
    }
    $result = $stm->get_result();
    $conn->close();
    
?>