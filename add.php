<?php include 'database.php' ?>
<?php
    if (isset($_POST['submit'])) {
        //GET Post variables
        $question_number = $_POST['question_number'];
        $question_text = $_POST['question_text'];
        //Get choices
        $choices = array();
        $choices[1] = $_POST['choice1'];
        $choices[2] = $_POST['choice2'];
        $choices[3] = $_POST['choice3'];
        $choices[4] = $_POST['choice4'];
        $correct_choice = $_POST['correct_choice'];

        /*
        * GET Total Questions
        */
        $query_t = "select * from `questions`";
        /*
         * GET Number of Rows
         */
        $result_t = $mysqli->query($query_t) or die($mysqli->error . __LINE__);
        $total = $result_t->num_rows;
        $next = $total+1;

        //Question Query
        if (!$question_text == '' && !$question_number == '') {
            $query_q = "insert into `questions` (question_number,text) values ('$question_number','$question_text')";
            // Run Query
            $insert_q = $mysqli->query($query_q) or die($mysqli->error . __LINE__);
            //Check validate insert
            if ($insert_q) {
                foreach ($choices as $choice => $value) {
                    if ($value != '') {
                        if ($correct_choice == $choice) {
                            $is_correct = 1;
                        } else {
                            $is_correct = 0;
                        }
                        $query_c = "insert into `choices` (question_number,is_correct,text) values ('$question_number',$is_correct,'$value')";
                        // Run Query
                        $insert_c = $mysqli->query($query_c) or die($mysqli->error . __LINE__);
                        //check validate
                        if ($insert_c) {
                            continue;
                        } else {
                            die('Error: (' . $mysqli->errno . ')' . $mysqli->error);
                        }
                    }
                }
                $msg = "Question has been added";
            }
        }
    }
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
        <h2>Add A Question</h2>
        <?php
            if (isset($msg)) {
                echo '<p>' . $msg . '</p>';
            }
        ?>
        <form method="post" action="add.php">
            <p>
                <label>Question Number: </label>
                <input type="number" value="<?php echo $next;?>" min="0" minlength="1" maxlength="11" name="question_number"/>
            </p>
            <p>
                <label>Question Text: </label>
                <input type="text" name="question_text"/>
            </p>
            <p>
                <label>Choice #1: </label>
                <input type="text" name="choice1"/>
            </p>
            <p>
                <label>Choice #2: </label>
                <input type="text" name="choice2"/>
            </p>
            <p>
                <label>Choice #3: </label>
                <input type="text" name="choice3"/>
            </p>
            <p>
                <label>Choice #4: </label>
                <input type="text" name="choice4"/>
            </p>
            <p>
                <label>Correct Choice Number: </label>
                <input type="number" min="1" max="4" name="correct_choice"/>
            </p>
            <p>
                <input type="submit" name="submit" value="submit"/>
            </p>
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
