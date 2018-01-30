<?php
    /*session_start();
    if(isset($_SESSION['Username'])){
    }
    else{
        header("Location:http://localhost/cs431/Front/login.html");
        exit;
    }*/
?>

<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="style.css">
    <link href='https://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Crete+Round' rel='stylesheet' type='text/css'>
    <header>
    </header>
    <body>
      <div class='questionCreateSelect'>
        <p class='addQuestion'>ADD A QUESTION</p>
            <p class='resultsText'>What type of question would you like to create?</p></br>
            <form name="addMC" method="post" action="frontAddMcQuestion.php">
              <input type='checkbox' name='mc' value='mc' checked hidden>
              <input class='mcBtn2' type='submit' value='MULTIPLE CHOICE'><br>
            </form>
            <form name="addFITB" method="post" action="frontAddFitbQuestion.php">
              <input type='checkbox' name='fitb' value='fitb' checked hidden>
              <input class='fitbBtn2' type='submit' name='fitb' value='FILL IN THE BLANK'><br>
            </form>
            <form name="addTF" method="post" action="frontAddTfQuestion.php">
              <input type='checkbox' name='tf' value='tf' checked hidden>
              <input class='tfBtn2' type='submit' name='tf' value='TRUE OR FALSE'><br>
            </form>
            <form name="addOE" method="post" action="frontAddOeQuestion.php">
              <input type='checkbox' name='oe' value='oe' checked hidden>
              <input class='oeBtn2' type='submit' name='oe' value='OPEN-ENDED'><br>
            </form>
        <form name="backToLogin" action="frontWelcomeTeacher.php">
          <input class="backBtnCreateQuestionSelect" type="submit" name="submit" id="submit" value="Back to Menu" style='top: 30px; left: 600px;'>
        </form>
      </div>
    </body>
</html>

<?php
    //session_destroy();
?>