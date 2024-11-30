<?php
include 'data.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM loaihoa WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Loài Hoa</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <?php if ($product): ?>
            <h2><?php echo $product['ten']; ?></h2>
            <div class="row">
                <div class="col-md-6">
                    <img src="<?php echo $product['anh'] ?: 'images/default.jpg'; ?>" class="img-fluid" alt="Ảnh loài hoa">
                </div>
                <div class="col-md-6">
                    <h4>Mô tả:</h4>
                    <p><?php echo $product['mota']; ?></p>
                </div>
            </div>
            <a href="user.php" class="btn btn-secondary mt-3">Quay lại</a>
        <?php else: ?>
            <p>Không tìm thấy thông tin loài hoa.</p>
        <?php endif; ?>
    </div>
    
    <script src="bootstrap/bootstrap.bundle.min.js"></script>
</body>
</html>
