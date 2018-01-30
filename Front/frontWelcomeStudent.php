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
  <body>
	<div class='createQuestionBox' style='background: rgb(178, 241, 222); width: 50%; padding: 50px;'>
     <p class='addQuestion'>Welcome Student, <?php echo $_SESSION['Username']; ?>!</p>
     <h3 class='resultsText'>v.release candidate</h3>
     <hr>
     <p class='resultsText'>What would you like to do today?</p>
        <form name="take" method="get" action="takeExam.php">
            <p>
                <input class="studentBtn2" type="button" value="TAKE EXAM" onclick="location.href='frontSelectExam.php'">
            </p>
        </form>
        <form name="view" method="get" action="results.php">
            <p>
                <input class="studentBtn2" type="button" value="VIEW EXAM RESULTS" onclick="location.href='frontResults.php'">
            </p>
        </form>
   		  <form name="backToLogin" action="login.html">
		      <input class="createQuestionSubmit" type="submit" name="submit" id="submit" value="Back to login">
		    </form>
    </div>
    </body>
</html>

<?php
    //session_destroy();
?>