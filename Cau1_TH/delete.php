<?php
include("data.php");
$id = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM loaihoa WHERE id = ?");
$stmt->execute([$id]);
header("Location: admin.php");
exit();
?>