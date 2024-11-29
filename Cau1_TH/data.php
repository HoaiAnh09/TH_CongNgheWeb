<?php
$conn = mysqli_connect("localhost" ,"root","","quanlyhoa");
$sql = "select*from loaihoa";
$result = mysqli_query( $conn, $sql );
while( $row = mysqli_fetch_array( $result ) ) {
    $id = $row["id"];
    $ten = $row["ten"];
    $mota = $row["mota"];
    $anh = $row['anh']?:null;
}