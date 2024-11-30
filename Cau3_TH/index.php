<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quanlysinhvien";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$sql = "SELECT * FROM accounts";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách tài khoản</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
</head>

<body>

    <div class="container mt-5">
        <header class="bg-light p-3 mb-4">
            <nav class="nav d-flex justify-content-center">
                <h1 class="text-center">Danh sách sinh viên</h1>
            </nav>
        </header>

        <?php
        if ($result->num_rows > 0) {
            echo "<table class='table table-bordered table-striped'>
                <thead class='thead-success'>
                    <tr>
                        <th>ID</th>
                        <th>Password</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>City</th>
                        <th>Email</th>
                        <th>Course</th>
                    </tr>
                </thead>
                <tbody>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>" . $row["username"] . "</td>
                    <td>" . $row["password"] . "</td>
                    <td>" . $row["firstname"] . "</td>
                    <td>" . $row["lastname"] . "</td>
                    <td>" . $row["city"] . "</td>
                    <td>" . $row["email"] . "</td>
                    <td>" . $row["course1"] . "</td>
                  </tr>";
            }

            echo "</tbody></table>";
        } else {
            echo "<div class='alert alert-warning'>Không có dữ liệu!</div>";
        }

        $conn->close();
        ?>

    </div>
</body>

</html>