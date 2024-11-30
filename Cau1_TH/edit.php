<?php
include 'data.php'; // Kết nối cơ sở dữ liệu

// Kiểm tra xem có ID loài hoa trong URL không
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM loaihoa WHERE id = ?");
    $stmt->bind_param("i", $id); // Đảm bảo tham số đúng kiểu số nguyên
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc(); // Lấy dữ liệu loài hoa
}

// Cập nhật thông tin loài hoa khi người dùng gửi form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ten = $_POST['ten'];
    $mota = $_POST['mota'];
    $linkanh = $product['anh']; // Giữ lại đường dẫn ảnh cũ nếu người dùng không tải ảnh mới

    // Kiểm tra xem người dùng có tải ảnh mới không
    if (!empty($_FILES['anh']['name'])) {
        $loadfile = 'images/';
        $linkanh = $loadfile . basename($_FILES['anh']['name']);
        move_uploaded_file($_FILES['anh']['tmp_name'], $linkanh); // Di chuyển ảnh tải lên
    }

    // Cập nhật thông tin loài hoa trong cơ sở dữ liệu
    $stmt = $conn->prepare("UPDATE loaihoa SET ten = ?, mota = ?, anh = ? WHERE id = ?");
    $stmt->bind_param("sssi", $ten, $mota, $linkanh, $id); // Gửi dữ liệu vào cơ sở dữ liệu

    if ($stmt->execute()) {
        header("Location: admin.php"); // Chuyển hướng về trang admin sau khi cập nhật thành công
        exit();
    } else {
        echo "Lỗi khi cập nhật dữ liệu: " . $stmt->error; // Thông báo lỗi nếu có
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Loài Hoa</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <style>
        .bg-light {
            background-image: linear-gradient(120deg, #1d4a69 0%, #90f99e 100%);
        }
    </style>
</head>
<body>

<header class="bg-light p-3 mb-4">
    <nav class="nav d-flex justify-content-center">
    <nav class="nav d-flex fs-1 justify-content-center" style="color:white;">
            <a>Sửa thông tin loài hoa</a>
    </nav>
    </nav>
</header>

<div class="container">
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="ten">Tên Hoa:</label>
            <input type="text" class="form-control" id="ten" name="ten" value="<?= htmlspecialchars($product['ten']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="mota">Mô Tả:</label>
            <textarea class="form-control" id="mota" name="mota" required><?= htmlspecialchars($product['mota']) ?></textarea>
        </div>
        <div class="mb-3">
            <label for="anh">Ảnh:</label>
            <input type="file" class="form-control" id="anh" name="anh" accept=".jpg,.jpeg,.png">
            <!-- Hiển thị ảnh cũ nếu có -->
            <img src="<?= htmlspecialchars($product['anh']) ?>" alt="Ảnh Hoa" width="100px" class="mt-2">
        </div>
        <button type="submit" class="btn btn-success">Lưu Thay Đổi</button>
        <a href="admin.php" class="btn btn-secondary">Quay lại</a>
    </form>
</div>

<script src="bootstrap/bootstrap.bundle.min.js"></script>
</body>
</html>
