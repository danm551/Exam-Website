<?php
    session_start();
    /*if(isset($_SESSION['Username'])){
    }
    else{
        header("Location:http://localhost/cs431/Front/login.html");
        exit;
    }

    if(empty($_POST['examSelect'])){
        echo "Please select an exam.";
        exit();
    }*/

    echo "<link rel='stylesheet' href='style.css'>
          <link href='https://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
          <link href='https://fonts.googleapis.com/css?family=Crete+Round' rel='stylesheet' type='text/css'>";

    $examName = $_POST['examSelect'];
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
    $resultArray = json_decode($response, true);
    //echo print_r($resultArray);
    
    echo "<div class='createQuestionBox' style='background: rgb(176, 231, 248);'>";
    echo "<form name='takeExam' id='takeExam' method='post' action='frontTakeExamProcess.php'";
    $counter = 1;
    foreach($resultArray as $value){
        if($value["Type"] == "mc"){
            $correct = "CorrectAnswer";
            $comm = "Comment";
            $a1 = $value["CorrectAnswer"];
            $a2 = $value["Answer2"];
            $a3 = $value["Answer3"];
            $a4 = $value["Answer4"];
            $a5 = $value["Answer5"];
            $answerArray = array($a1, $a2, $a3, $a4, $a5);
            $shuffle = shuffle($answerArray);
            echo "<p class='resultsText' class='resultsText' style='font-size: 30;'>".$counter.") ".$value["Question"]."</p>";
            
            echo "<p class='resultsText' style='font-size: 20;'><input type='radio' name='$counter' value='$answerArray[0]'>".$answerArray[0]."</p>";
            echo "<p class='resultsText' style='font-size: 20;'><input type='radio' name='$counter' value='$answerArray[1]'>".$answerArray[1]."</p>";
            echo "<p class='resultsText' style='font-size: 20;'><input type='radio' name='$counter' value='$answerArray[2]'>".$answerArray[2]."</p>";
            echo "<p class='resultsText' style='font-size: 20;'><input type='radio' name='$counter' value='$answerArray[3]'>".$answerArray[3]."</p>";
            echo "<p class='resultsText' style='font-size: 20;'><input type='radio' name='$counter' value='$answerArray[4]'>".$answerArray[4]."</p>";
            $_SESSION['answer'. $counter] = $value[$correct];
        }
        else if($value["Type"] == "fitb"){
            $correct = "CorrectAnswer";
            $comm = "Comment";
            echo "<p class='resultsText' class='resultsText' style='font-size: 30;'>".$counter.") ".$value["Question"]."</p>";
            echo "<p class='resultsText' style='font-size: 20;'>Answer: <input type='text' name='$counter'></p>";
            $_SESSION['answer'. $counter] = $value[$correct];
        }
        else if($value["Type"] == "tf"){
            $correct = "CorrectAnswer";
            $comm = "Comment";
            echo "<p class='resultsText' style='font-size: 30;'>".$counter.") ".$value["Question"]."</p>";
            echo "<p class='resultsText' style='font-size: 20;'>True<input class='resultsText' style='font-size: 20;' type='radio' name='$counter' value='true'></p>";
            echo "<p class='resultsText' style='font-size: 20;'>False<input class='resultsText' style='font-size: 20;' type='radio' name='$counter' value='false'></p>";
            $_SESSION['answer'. $counter] = $value[$correct];
        }
        else if($value["Type"] == "oe"){
            $arg1 = null;
            $arg2 = null;
            $arg3 = null;
            $arg4 = null;
            $type1 = null;
            $type2 = null;
            $type3 = null;
            $type4 = null;
      
            $funcName = "FuncName";
            $correct = "CorrectAnswer";
            $returns = "Returns";
            echo "<p class='resultsText' style='font-size: 30;'>".$counter.") ".$value["Question"]."</p>";
            echo "<p class='resultsText' style='font-size: 20;'>Answer: <textarea name='oe$counter' rows=15 cols=75></textarea></p>";
            $_SESSION['oe-answer'. $counter] = $value[$correct];
            echo "<input type='radio' name='oe-funcName$counter' value='$value[$funcName]' checked hidden>";
            
            if($value['Type1']){
              $type1 = $value['Type1'];
              echo "<input type='radio' name='type1-$counter' value='$type1' checked hidden>";
            }
            if($value['Type2']){
              $type2 = $value['Type2'];
              echo "<input type='radio' name='type2-$counter' value='$type2' checked hidden>";
            }
            if($value['Type3']){
              $type3 = $value['Type3'];
              echo "<input type='radio' name='type3-$counter' value='$type3' checked hidden>";
            }
            if($value['Type4']){
              $type4 = $value['Type4'];
              echo "<input type='radio' name='type4-$counter' value='$type4' checked hidden>";
            }
            if($value['Arg1']){
              $arg1 = $value['Arg1'];
              $arg1 = str_replace("'", "\"", $arg1);
              echo "<input type='radio' name='arg1-$counter' value='$arg1' checked hidden>";
            }
            if($value['Arg2']){
              $arg2 = $value['Arg2'];
              $arg2 = str_replace("'", "\"", $arg2);
              echo "<input type='radio' name='arg2-$counter' value='$arg2' checked hidden>";
            }
            if($value['Arg3']){
              $arg3 = $value['Arg3'];
              $arg3 = str_replace("'", "\"", $arg3);
              echo "<input type='radio' name='arg3-$counter' value='$arg3' checked hidden>";
            }
            if($value['Arg4']){
              $arg4 = $value['Arg4'];
              $arg4 = str_replace("'", "\"", $arg4);
              echo "<input type='radio' name='arg4-$counter' value='$arg4' checked hidden>";
            }
            
            echo "<input type='radio' name='returns$counter' value='$value[$returns]' checked hidden>";
        }
        echo "<hr style='margin-top: 4%; margin-bottom: 4%;'>";
        $counter++;
    }
    echo "<input type='radio' name='qCount' value='$counter' checked hidden>";
    echo "<input type='radio' name='examName' value='$examName' checked hidden>";
    echo "<input type='submit' name='submit' value='Submit'>";
    echo "</form>
	  </div>";
?>

<?php
    //session_destroy();
?>
