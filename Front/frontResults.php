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
    $userName = $_SESSION['Username'];
    $post = "Username=".$userName;
    //$url = "https://web.njit.edu/~edm8/cs490/Middle/middleGetUserExams.php";
    $url = "https://web.njit.edu/~tkt6/cs490/Middle/middleGetUserExams.php";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $response = curl_exec($ch);
    curl_close($ch);
    $resultArray = json_decode($response, true);
    //echo $response;
    
    echo "<p class='resultsText' style='margin-left: 30%; margin-top: 15%; font-size: 200%;'>Select exam:</p>";
    foreach($resultArray as $value){
	  echo "<form name='examSelect' method='post' action='frontResultsProcess.php'>
              	<input type='checkbox' name='examName' value='$value' checked hidden>
                <input class='selectExamBtn' type='submit' value='$value' style='position: relative; left: 23%; width: 30%;'><br><br>
	        </form>";
    }
?>

<?php
    //session_destroy();
?>
