<?php
  $qType = $_POST['qType'];
  $question = $_POST['question'];
  $answer1 = $_POST['answer1'];
  $answer2 = $_POST['answer2'];
  $answer3 = $_POST['answer3'];
  $answer4 = $_POST['answer4'];
  $answer5 = $_POST['answer5'];
  $comm = $_POST['comm'];
  $funcName = $_POST['funcName'];
  $returns = $_POST['returns'];
  $args = $_POST['args'];
  $arg1 = $_POST['arg1'];
  $arg2 = $_POST['arg2'];
  $arg3 = $_POST['arg3'];
  $arg4 = $_POST['arg4'];
  $type1 = $_POST['type1'];
  $type2 = $_POST['type2'];
  $type3 = $_POST['type3'];
  $type4 = $_POST['type4'];
  
  if($qType == "oe"){
    $post = 'qType='.$qType.'&funcName='.urlencode($funcName).'&args='.$args.'&question='.urlencode($question)."&returns=".$returns;
    for($i = 0; $i < 5; $i++){
  	    if($_POST['arg' . $i]){
          $post = $post . "&arg" . $i . "=" . $_POST['arg' . $i];
  		    $counter++;
      	}
    }  
    $counter = 0;    
    for($i = 0; $i < 5; $i++){
      if($_POST['type' . $i]){
          $post = $post . "&type" . $i . "=" . $_POST['type' . $i];
  		    $counter++;
     	}
    }
    $post = $post .'&answer1='.urlencode($answer1);
  }
  else
  $post = 'qType='.$qType.'&question='.urlencode($question).'&answer1='.urlencode($answer1).'&answer2='.urlencode($answer2).'&answer3='.urlencode($answer3).'&answer4='.urlencode($answer4)
  .'&answer5='.urlencode($answer5).'&comm='.urlencode($comm);
  
  //echo $post;
  $url = "https://web.njit.edu/~edm8/cs490/Back/backAddQuestionProcess.php";
  
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, TRUE);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE); 
  $response = curl_exec($ch);
  curl_close($ch);
  //echo $response;
?>