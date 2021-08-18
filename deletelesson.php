<?php
require("conn.php");
if (isset($_GET["id"]) && isset($_GET["idlesson"]) && isset($_GET["period"])) {
    $id = $_GET["id"];
    $idlesson = $_GET["idlesson"];
    $period = $_GET["period"];
}
$sql = "DELETE FROM lesson_info WHERE id = $idlesson";
if ($conn->query($sql) == true) {
    header("Location: subject.php?id=$id&period=$period");
    exit();
}

$conn->close();
?>