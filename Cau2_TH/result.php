<?php
// Đọc nội dung từ file quiz.txt
$filename = 'quiz.txt';
$lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$answers = [];
foreach ($lines as $line) {
    if (strpos($line, 'ANSWER:') === 0) {
        $answers[] = trim(substr($line, 7)); // Lấy đáp án từ dòng "ANSWER: X"
    }
}

// Xử lý kết quả từ form
$userAnswers = $_POST;
$score = 0;

foreach ($answers as $index => $correctAnswer) {
    $userAnswerKey = "question_$index";
    if (isset($userAnswers[$userAnswerKey]) && $userAnswers[$userAnswerKey] === $correctAnswer) {
        $score++;
    }
}

// Tổng số câu hỏi
$totalQuestions = count($answers);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết Quả</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="alert alert-success text-center">
            <h2>Kết Quả</h2>
            <p>Bạn đã trả lời đúng <strong><?php echo $score; ?></strong> trên tổng số <strong><?php echo $totalQuestions; ?></strong> câu hỏi.</p>
        </div>
        <div class="text-center">
            <a href="index.php" class="btn btn-primary">Làm lại</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
