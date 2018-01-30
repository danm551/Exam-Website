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
	<div class='createQuestionBox' style='background: rgb(176, 231, 248); width: 50%; padding: 50px;'>
     <p class='addQuestion'>Welcome Instructor, <?php echo $_SESSION['Username']; ?>!</p>
     <h3 class='resultsText'>v.release candidate</h3>
     <hr>
     <p class='resultsText'>What would you like to do today?</p>
		<form name="addquestion" method="post" action="addQuestion.php">
		    <p>
		        <input class="teachBtn2" type="button" value="ADD QUESTION" onclick="location.href='frontCreateQuestionSelect.php'">
		    </p>
		</form>
		<form name="create" method="post" action="createExam.php">
		    <p>
		        <input class="teachBtn2" type="button" value="CREATE EXAM" onclick="location.href='frontCreateExam.php'">
		    </p>
		</form>
		<form name="release" method="post" action="frontRelease.php">
		    <p>
		        <input class="teachBtn2" type="button" value="RELEASE GRADES" onclick="location.href='frontRelease.php'">
		    </p>
		</form>
		<form name="release" method="post" action="frontRemoveQuestion.php">
		    <p>
		        <input class="teachBtn2" type="button" value="DELETE QUESTIONS" onclick="location.href='frontRemoveQuestion.php'">
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
