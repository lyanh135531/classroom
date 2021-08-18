<?php
require("conn.php");
if (isset($_GET["id"]) && isset($_GET["period"])) {
    $id = $_GET["id"];
    $period = $_GET["period"];
}
$sql = "DELETE FROM notify_info WHERE idclass = $id";
if ($conn->query($sql) == true) {
    header("Location: subject.php?id=$id&period=$period");
    exit();
}

$conn->close();
?>