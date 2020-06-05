<?php include 'database.php' ?>
<?php
    /*
     * GET Total Questions
    */
    $query_t = "select * from `questions`";
    /*
     * GET Number of Rows
     */
    $result_t = $mysqli->query($query_t) or die($mysqli->error . __LINE__);
    $total = $result_t->num_rows;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>PHP Quizzer</title>
    <link rel="stylesheet" href="css/style.css" type="text/css"/>
</head>
<body>
<header>
    <div class="container">
        <h1>PHP Quizzer</h1>
    </div>
</header>
<main>
    <div class="container">
        <h2>Test Your PHP Knowledge</h2>
        <p>This is multiple choice to test your knowledge of PHP</p>
        <ul>
            <li><STRONG>Number of Questions: </STRONG><?php echo $total; ?></li>
            <li><STRONG>Type: </STRONG>Multiple Choice.</li>
            <li><STRONG>Estimated Time: </STRONG><?php echo $total * .5 . ' Minutes.'; ?></li>
        </ul>
        <a href="question.php?n=1" class="start">Start Quiz</a>
    </div>
</main>
<footer>
    <div class="container">
        Copyright &copy; 2019, PHP Quizzer
    </div>
</footer>
</body>
</html>
