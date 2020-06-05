<?php include 'database.php' ?>
<?php session_start(); ?>
<?php
    // set question number
    $number = (int)$_GET['n'];

    /*
     * GET QUESTION
     */
    $query_q = "select * from `questions` where question_number = $number";
    /*
     * Get Result
     */
    $result_q = $mysqli->query($query_q) or die($mysqli->error . __LINE__);
    $question = $result_q->fetch_assoc();
    /*
    * GET CHOICES
    */
    $query_c = "select * from `choices` where question_number = $number";
    /*
     * Get Results
     */
    $choices = $mysqli->query($query_c) or die($mysqli->error . __LINE__);
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
        <div class="current">Question <?php echo $number . " of " . $total ?></div>
        <p class="question">
            <?php echo $question['text'] . '?' ?>
        </p>
        <form method="post" action="process.php">
            <ul class="choices">
                <?php while ($row = $choices->fetch_assoc()) : ?>
                    <li><input name="choice" type="radio" value="<?php echo $row['id']; ?>"/><?php echo $row['text']; ?>
                    </li>
                <?php endwhile; ?>
            </ul>
            <input type="submit" value="submit">
            <input type="hidden" name="number" value="<?php echo $number; ?>">
        </form>
    </div>
</main>
<footer>
    <div class="container">
        Copyright &copy; 2019, PHP Quizzer
    </div>
</footer>
</body>
</html>
