<?php
include 'data.php';

// Lấy câu hỏi từ cơ sở dữ liệu
$sql = "SELECT * FROM questions";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $questions = $result->fetch_all(MYSQLI_ASSOC); // Lấy tất cả câu hỏi
} else {
    $questions = [];
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài kiểm tra trắc nghiệm</title>
    <link rel="stylesheet" href="./bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="icon/bootstrap-icons.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Bài kiểm tra trắc nghiệm</h1>
        <form action="result.php" method="POST">
            <?php
            foreach ($questions as $question) { ?>
                <div class="card mb-4">
                    <div class="card-header"><strong><?php echo $question['question_text']; ?></strong></div>
                    <div class="card-body">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="question<?php echo $question['id']; ?>" value="A" id="question<?php echo $question['id']; ?>A">
                            <label class="form-check-label" for="question<?php echo $question['id']; ?>A">A. <?php echo $question['option_a']; ?></label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="question<?php echo $question['id']; ?>" value="B" id="question<?php echo $question['id']; ?>B">
                            <label class="form-check-label" for="question<?php echo $question['id']; ?>B">B. <?php echo $question['option_b']; ?></label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="question<?php echo $question['id']; ?>" value="C" id="question<?php echo $question['id']; ?>C">
                            <label class="form-check-label" for="question<?php echo $question['id']; ?>C">C. <?php echo $question['option_c']; ?></label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="question<?php echo $question['id']; ?>" value="D" id="question<?php echo $question['id']; ?>D">
                            <label class="form-check-label" for="question<?php echo $question['id']; ?>D">D. <?php echo $question['option_d']; ?></label>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <button type="submit" class="btn btn-success">Nộp bài</button>
        </form>
    </div>
</body>
</html>
