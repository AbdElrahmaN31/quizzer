<?php include 'database.php' ?>
<?php session_start(); ?>
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
<?php
//Check to see if score is set_error_handler
    if (!isset($_SESSION['score'])) {
        $_SESSION['score'] = 0;
    }

    if ($_POST) {
        $questionNumber = $_POST['number'];
        $selectedAnswer = $_POST['choice'];
        $next = $questionNumber + 1;

        /*
        *  Get correct choice
        */
        $query = "select * from `choices` where question_number = $questionNumber AND  is_correct=1";
        // Get result
        $result = $mysqli->query($query) or die($mysqli->error . __LINE__);
        //Get row
        $row = $result->fetch_assoc();
        //Get correct choice
        $correct_choice = $row['id'];
        if ($selectedAnswer == $correct_choice) {
            $_SESSION['score'] += 1 ;
        }

        if ($questionNumber == $total){
            header("Location: final.php");
        }else{
            header("location: question.php?n=" .$next);
        }

    }
