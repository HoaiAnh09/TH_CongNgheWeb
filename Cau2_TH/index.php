<?php
$filename = 'quiz.txt';
$lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$questions = [];
$current_question = [];
foreach ($lines as $line) {
    if (strpos($line, 'ANSWER:') === 0) {
        $current_question[] = $line;
        $questions[] = $current_question; 
        $current_question = [];
    } else {
        $current_question[] = $line; 
    }
}


$totalQuestions = count($questions);
$questionsPerPage = 3;


$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($currentPage < 1) $currentPage = 1;


$startIndex = ($currentPage - 1) * $questionsPerPage;
$endIndex = min($startIndex + $questionsPerPage, $totalQuestions);

$currentQuestions = array_slice($questions, $startIndex, $questionsPerPage);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài Trắc Nghiệm Android</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Bài Trắc Nghiệm Android</h1>
        <form method="POST" action="result.php">
            <?php foreach ($currentQuestions as $index => $question): ?>
                <?php
                $questionText = $question[0]; 
                $answers = array_slice($question, 1, -1);
                ?>
                <div class="card mb-4">
                    <div class="card-header">
                        <strong><?php echo "Câu hỏi " . ($startIndex + $index + 1) . ": " . htmlspecialchars($questionText); ?></strong>
                    </div>
                    <div class="card-body">
                        <?php foreach ($answers as $answer): ?>
                            <?php
                            $answerLabel = substr($answer, 0, 1); 
                            ?>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question_<?php echo $startIndex + $index; ?>" value="<?php echo $answerLabel; ?>" id="question<?php echo $startIndex + $index . $answerLabel; ?>">
                                <label class="form-check-label" for="question<?php echo $startIndex + $index . $answerLabel; ?>">
                                    <?php echo htmlspecialchars($answer); ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>

            
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Nộp bài</button>
            </div>
        </form>

        <div class="pagination mt-4 text-center">
            <?php if ($currentPage > 1): ?>
                <a class="btn btn-secondary me-2" href="?page=<?php echo $currentPage - 1; ?>">Trang trước</a>
            <?php endif; ?>
            <?php if ($endIndex < $totalQuestions): ?>
                <a class="btn btn-secondary" href="?page=<?php echo $currentPage + 1; ?>">Trang tiếp</a>
            <?php endif; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
