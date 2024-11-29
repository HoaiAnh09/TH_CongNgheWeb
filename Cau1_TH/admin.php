<?php
include 'data.php';

$sql = "SELECT * FROM loaihoa";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quản trị loài hoa</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="node_modules/bootstrap-icons/icons">
</head>
<body>
    <h1>Quản trị loài hoa</h1>
    <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success">Thêm mới thành công!</div>
        <?php endif; ?>

        <a href="add.php" class="btn btn-success mb-3">+ Thêm mới</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Mô tả</th>
            <th>Ảnh</th>
            <th>Hành động</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['ten']; ?></td>
                <td><?php echo $row['mota']; ?></td>
                <td><img src="<?php echo $row['anh'] ?: 'images/default.jpg'; ?>" width="100"></td>
                <td>
                <a href="edit.php?id=<?php echo $id;?>">
                <img src="node_modules/bootstrap-icons/icons/pencil-square.svg" alt="Sửa" style="width: 16px; height: 16px;">
                </a>
                <a href="delete.php?id=<?php echo $id;?>">
                <img src="node_modules/bootstrap-icons/icons/trash-fill.svg" alt="Xóa" style="width: 16px; height: 16px;">
                </a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

</body>
</html>
