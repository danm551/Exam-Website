<?php
    session_start();
    if(isset($_SESSION['Username'])){
    }
    else{
        header("Location:https://web.njit.edu/~edm8/cs490/Front/login.html");
        exit;
    }
?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="style.css">
<link href='https://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Crete+Round' rel='stylesheet' type='text/css'>
    <header>
    </header>
    <body>
    </body>
</html>

<?php
    //$url = "https://web.njit.edu/~edm8/cs490/Middle/middleGetExams.php";
    $url = "https://web.njit.edu/~tkt6/cs490/Middle/middleGetExams.php";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $response = curl_exec($ch);
    curl_close($ch);
    $resultArray = json_decode($response, true);
    
    echo "<p class='resultsText' style='margin-left: 30%; margin-top: 15%; font-size: 200%;'>Select an exam:</p>";
    foreach($resultArray as $value){
    echo "<form name='$value' method='post' action='frontTakeExam.php'>
            <input type='checkbox' name='examSelect' value='$value' checked hidden>
            <input class='selectExamBtn' type='submit' value='$value' style='position: relative; left: 23%; width: 30%;'><br><br>";
    echo "</form>";
    }
?>

<?php
    //session_destroy();
?>
