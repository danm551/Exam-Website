<?php
  $qType = $_POST['qType'];
  
  if(!strcmp($qType, "mc")){
      $question = $_POST['mc-question'];
      $answer1 = $_POST['mc-a1'];
      $answer2 = $_POST['mc-a2'];
      $answer3 = $_POST['mc-a3'];
      $answer4 = $_POST['mc-a4'];
      $answer5 = $_POST['mc-a5'];
      $comm = $_POST['mc-comm'];
      if($question == null || $answer1 == null || $answer2 == null || $answer3 == null || $answer4 == null || $answer5 == null){
          echo "Please fill all the boxes pertaining to your selected question type.";
          exit();
      }
      $post = 'qType='.$qType.'&question='.urlencode($question).'&answer1='.urlencode($answer1).'&answer2='.urlencode($answer2).'&answer3='.urlencode($answer3)
      .'&answer4='.urlencode($answer4).'&answer5='.urlencode($answer5).'&comm='.urlencode($comm);
      $url = "https://web.njit.edu/~edm8/cs490/Middle/middleAddQuestionProcess.php";
      //$url = "https://web.njit.edu/~tkt6/cs490/Middle/middleAddQuestionProcess.php";
  }
  else if(!strcmp($qType, "fitb")){
      $question = $_POST['fitb-question'];
      $answer1 = $_POST['fitb-a1'];
      $comm = $_POST['fitb-comm'];
      if($question == null || $answer1 == null){
          echo "Please fill all the boxes pertaining to your selected question type.";
          exit();
      }
      $post = 'qType='.$qType.'&question='.urlencode($question).'&answer1='.urlencode($answer1)."&comm=".urlencode($comm);
      $url = "https://web.njit.edu/~edm8/cs490/Middle/middleAddQuestionProcess.php";
      //$url = "https://web.njit.edu/~tkt6/cs490/Middle/middleAddQuestionProcess.php";
  }
  else if(!strcmp($qType, "tf")){
      $question = $_POST['tf-question'];
      $answer1 = $_POST['tf-a1'];
      $comm = $_POST['tf-comm'];
      if($question == null || $answer1 == null){
          echo "Please fill all the boxes pertaining to your selected question type.";
          exit();
      }
      $post = 'qType='.$qType.'&question='.urlencode($question).'&answer1='.urlencode($answer1)."&comm=".urlencode($comm);
      $url = "https://web.njit.edu/~edm8/cs490/Middle/middleAddQuestionProcess.php";
      //$url = "https://web.njit.edu/~tkt6/cs490/Middle/middleAddQuestionProcess.php";
  }
  else if(!strcmp($qType, "oe")){
      $funcName = $_POST['oe-funcName'];
      $returns = $_POST['oe-returns'];
      $args = $_POST['args'];
      $answer1 = $_POST['oe-a1'];
      $arg1 = $_POST['oe-arg1'];
      $arg2 = $_POST['oe-arg2'];
      $arg3 = $_POST['oe-arg3'];
      $arg4 = $_POST['oe-arg4'];
      $type1 = $_POST['oe-type1'];
      $type2 = $_POST['oe-type2'];
      $type3 = $_POST['oe-type3'];
      $type4 = $_POST['oe-type4'];
      $question = "Write a function named " . $funcName . " that takes " . $args . " argument(s), " . str_replace("\"", "'",$_POST['oe-question']) . " and returns a(n) " . $returns .
                  ". The function arguments are: ";
                  if($arg1){
                    $arg1 = str_replace("\"", "'",$arg1);
                    $question = $question.$arg1;
                  }
                  if($arg2){
                    $arg2 = str_replace("\"", "'",$arg2);
                    $question = $question . " ," .$arg2;
                  }
                  if($arg3){
                    $arg3 = str_replace("\"", "'",$arg3);
                    $question = $question . " ," . $arg3;
                  }
                  if($arg4){
                    $arg4 = str_replace("\"", "'",$arg4);
                    $question = $question . " ," . $arg4;
                  }
                   
                  $question = $question . " of type(s): ";
                   
                  if($type1)
                    $question = $question.$type1;
                  if($type2)
                    $question = $question . " ," . $type2;
                  if($type3)
                    $question = $question . " ," . $type3;
                  if($type4) 
                    $question = $question . " ," . $type4;
      
                  $question = $question . ", respectively.";
      
      if($question == null || $answer1 == null){
          echo "Please fill out all the boxes pertaining to your selected question type.";
          exit();
      }
      
      //counts how many args are set and prepares arg segment of $post string
      $post = 'qType='.$qType.'&funcName='.urlencode($funcName).'&args='.$args.'&question='.urlencode($question)."&returns=".$returns;
      //adds args to post
      $counter = 0;
      for($i = 0; $i < 5; $i++){
  	    if($_POST['oe-arg' . $i]){
          $post = $post . "&arg" . $i . "=" . $_POST['oe-arg' . $i];
  		    $counter++;
      	}
      }
      if($counter != $args){
          echo "The number of selected arguments and the number of included arguments does not match.";
          exit();
      }
      //checks for semicolons in argument text boxes
      $result1 = strpos($arg1, ";");
      $result2 = strpos($arg2, ";");
      $result3 = strpos($arg3, ";");
      $result4 = strpos($arg4, ";");
      
      if($result1 != false || $result2 != false || $result3 != false || $result4 != false){
        echo "Semicolon is present in argument field(s).";
        exit();
      }
      //adds arg types to post
      $counter = 0;    
      for($i = 0; $i < 5; $i++){
  	    if($_POST['oe-type' . $i]){
          $post = $post . "&type" . $i . "=" . $_POST['oe-type' . $i];
  		    $counter++;
      	}
      }
      
      $post = $post .'&answer1='.urlencode($answer1);
      $url = "https://web.njit.edu/~edm8/cs490/Middle/middleAddQuestionProcess.php";
      //$url = "https://web.njit.edu/~tkt6/cs490/Middle/middleAddQuestionProcess.php";
  }
  
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, TRUE);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE); 
  $response = curl_exec($ch);
  curl_close($ch);
  echo $response;
  
  if($qType == "mc")
    header("Location: https://web.njit.edu/~edm8/cs490/Front/frontAddMcQuestion.php");
  else if($qType == "fitb")
    header("Location: https://web.njit.edu/~edm8/cs490/Front/frontAddFitbQuestion.php");
  else if($qType == "tf")
    header("Location: https://web.njit.edu/~edm8/cs490/Front/frontAddTfQuestion.php");
  else
    header("Location: https://web.njit.edu/~edm8/cs490/Front/frontAddOeQuestion.php");
?>
