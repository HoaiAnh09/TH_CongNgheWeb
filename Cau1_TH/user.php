<?php
include 'data.php';

$sql = "SELECT * FROM loaihoa";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Danh Sách Loài Hoa</title>
    <link rel="stylesheet" href="style_user.css">
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
        <h2 class="text-center">Danh Sách Loài Hoa</h2>
        <div class="row">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="<?php echo $row['anh'] ?: 'images/default.jpg'; ?>" class="card-img-top" alt="Ảnh loài hoa" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['ten']; ?></h5>
                            <p class="card-text"><?php echo substr($row['mota'], 0, 100); ?>...</p>
                            <a href="product.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    
    <script src="bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
