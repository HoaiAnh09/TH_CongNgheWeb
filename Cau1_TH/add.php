<?php
include 'data.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ten = $_POST['ten'];
    $mota = $_POST['mota'];
    $anh = $_POST['anh'] ?: null;
    if (isset($_FILES['anh']) && $_FILES['anh']['error'] == 0) {
        $allowed_ext = ['jpg', 'jpeg', 'png']; // Các định dạng ảnh được phép
        $file_info = pathinfo($_FILES['anh']['name']);
        $ext = strtolower($file_info['extension']);

        // Kiểm tra xem định dạng file có hợp lệ không
        if (in_array($ext, $allowed_ext)) {
            // Tạo đường dẫn lưu file
            $upload_dir = 'uploads/';
            $new_file_name = uniqid() . '.' . $ext; // Đổi tên file để tránh trùng lặp
            $upload_path = $upload_dir . $new_file_name;

            // Di chuyển file upload đến thư mục 'uploads'
            if (move_uploaded_file($_FILES['anh']['tmp_name'], $upload_path)) {
                $anh = $upload_path; // Lưu đường dẫn ảnh vào cơ sở dữ liệu
            } else {
                echo "Lỗi khi tải lên ảnh.";
                exit();
            }
        } else {
            echo "Chỉ chấp nhận các file JPG, JPEG, PNG.";
            exit();
        }
    }

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
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
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
                <input type="file" class="form-control" id="anh" name="anh" accept=".jpg,.jpeg,.png">
            </div>
            <button type="submit" class="btn btn-primary">Lưu</button>
            <a href="admin.php" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</body>
</html>
