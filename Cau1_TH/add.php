<?php
include 'data.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ten = $_POST['ten'];
    $mota = $_POST['mota'];
    $anh = $_POST['anh'] ?: null;

    if (empty($ten) || empty($mota)) {
        echo "Tên hoa và mô tả không được để trống.";
    } else {
        $stmt = $conn->prepare("INSERT INTO loaihoa (ten, mota, anh) VALUES (?, ?, ?)");
        
        if ($stmt === false) {
            die('Lỗi câu lệnh SQL: ' . $conn->error);
        }

        $stmt->bind_param("sss", $ten, $mota, $anh);

        if ($stmt->execute()) {
            header("Location: admin.php?success=1");
            exit();
        } else {
            echo "Lỗi khi thêm dữ liệu: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Thêm Loài Hoa</title>
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Thêm Loài Hoa</h2>
        <form method="POST" action="add.php">
            <div class="mb-3">
                <label for="ten" class="form-label">Tên Hoa:</label>
                <input type="text" id="ten" name="ten" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="mota" class="form-label">Mô Tả:</label>
                <textarea id="mota" name="mota" class="form-control" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="anh" class="form-label">Ảnh:</label>
                <input type="text" id="anh" name="anh" class="form-control" placeholder="Nhập URL ảnh hoặc để trống">
            </div>
            <button type="submit" class="btn btn-primary">Lưu</button>
            <a href="admin.php" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</body>
</html>
