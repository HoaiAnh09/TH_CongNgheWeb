<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quanlysinhvien";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$file = fopen("KTPM3_Danh_sach_diem_danh.csv", "r");

fgetcsv($file);

while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
    $username = $data[0];
    $password = $data[1];
    $firstname = $data[2];
    $lastname = $data[3];
    $city = $data[4];
    $email = $data[5];
    $course_id = $data[6];

    $stmt = $conn->prepare("INSERT INTO accounts (username, password, firstname, lastname, city, email, course_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $username, $password, $firstname, $lastname, $city, $email, $course_id);
    $stmt->execute();
}

fclose($file);

echo "Dữ liệu đã được nhập thành công.";

$conn->close();