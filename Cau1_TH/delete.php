<?php 
$conn = mysqli_connect("localhost","root","","quanlyhoa");
$masv = $_GET['id'];
$sql = "delete from loaihoa where id = '$id'";
if(mysqli_query($conn, $sql)) {
    header("location: admin.php");
} else {
    $result = "Xóa không thành công" . mysqli_error($conn);
}
mysqli_close($conn);
?>