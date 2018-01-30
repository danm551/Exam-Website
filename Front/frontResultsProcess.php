<!DOCTYPE html>
<html>
<head>
<meta chatset="UTF-8">  
</head>
<body>
<link rel="stylesheet" href="style.css">
<link href='https://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Crete+Round' rel='stylesheet' type='text/css'>
</body>
</html>

<?php
    if(empty($_POST['examName'])){
        echo "Please select an exam.";
        exit();
    }

    //code block that retrives questions/answers
    $examName = $_POST['examName'];
    $post = "examName=".$examName;
    //$url = "https://web.njit.edu/~edm8/cs490/Middle/middleTakeExam.php";
    $url = "https://web.njit.edu/~tkt6/cs490/Middle/middleTakeExam.php";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $response = curl_exec($ch);
    //echo $response;
    curl_close($ch);
    $questions = json_decode($response, true);
    //print_r($questions);

    //code block that retrieves user answers
    //$url = "https://web.njit.edu/~edm8/cs490/Middle/middleResultsProcess.php";
    $url = "https://web.njit.edu/~tkt6/cs490/Middle/middleResultsProcess.php";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE); 
    $response = curl_exec($ch);
    curl_close($ch);
    //echo $response;
    $answers = json_decode($response,true);
    //print_r($answers);
    
    //calculates final score
    //print_r($answers);
    $finalScore = 0;
    $counter = 0;
    $i = 0;
    foreach($questions as $value){
      $question = ($counter+1);
      if(array_search($question, $answers[1]) !== false){
        $finalScore = ($finalScore+$answers[4][($counter)]);
      }
      $counter++;
    }
    foreach($answers[4] as $value){
        $totalScore = ($totalScore+$value);
    }
    echo "<div class='resultsBox'>
          <div class='finalScore'>SCORE: " . $finalScore . "/" . $totalScore . "</div>";
    
    //output
    $counter = 0;
    $oeCounter = 0;
    foreach($questions as $value){
        $question = ($counter+1);
        if(array_search($question, $answers[1]) !== false){
            echo "<p class='resultMarks'><font color='#00b300' size='12'>&#10003</font></p>";
            if($value["Type"] == "oe"){
              echo "<p class='resultsText'>".$question.")  &nbsp&nbsp" . $value["Question"]. "</p>";
              echo "<p class='resultsText'>Your answer: &nbsp&nbsp".$answers[3][$oeCounter]."</p><br>";
              $oeCounter++;
              echo "<p class='resultsText'>Correct answer: &nbsp&nbsp".$questions[$counter]["CorrectAnswer"]."</p><br>";
              echo "<p class='resultsText'>Question point value: &nbsp&nbsp".$answers[4][($counter)]."</p><br>";
              echo "<hr>";
              $counter++;
            }
        }
        else{
            echo "<p class='resultMarks'><font color='#990000' size='12'>&#10006;</font></p>";
            if($value["Type"] == "oe"){
              echo "<p class='resultsText'>".$question.")  &nbsp&nbsp" . $value["Question"] . "</p>";
              if($answers[3][$oeCounter] == "bad compile")
                echo "<p class='resultsText'>Your answer: &nbsp&nbspyour code did not compile.</p><br>";
              else if($answers[3][$oeCounter] == "output mismatch")
                echo "<p class='resultsText'>Your answer: &nbsp&nbspyour code compiled correctly but your answer was wrong.</p><br>";
              $oeCounter++;
              echo "<p class='resultsText'>Correct answer: &nbsp&nbsp".$questions[$counter]["CorrectAnswer"]."</p><br>";
              echo "<p class='resultsText'>Question point value: &nbsp&nbsp".$answers[4][($counter)]."</p><br>";
              echo "<hr>";
              $counter++;
          }
        }
        if($value["Type"] != "oe"){
          echo "<p class='resultsText'>".$question.")  &nbsp&nbsp" . $value["Question"] . "</p>";
          echo "<p class='resultsText'>Your answer: &nbsp&nbsp".$answers[0][$counter]."</p><br>";
          echo "<p class='resultsText'>Correct answer: &nbsp&nbsp".$questions[$counter]["CorrectAnswer"]."</p><br>";
          echo "<p class='resultsText'>Question point value: &nbsp&nbsp".$answers[4][($counter)]."</p><br>";
          if(array_search($question, $answers[1]) === false)
            echo "<p class='resultsText'><font size=4 color='blue' size='12'>Intructor's comment: </font>".$questions[$counter]["Comment"]."</p><br>";
          echo "<hr>";
          $counter++;
        }
    }
    echo "<form name='backToLogin' action='frontWelcomeStudent.php'>
            <input class='backBtnResults' type='submit' name='submit' id='submit' value='Back to Menu'>
          </form>
          </div>";
?>