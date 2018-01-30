<?php
  //echo print_r($_POST);
  
  $keyList = array();
  $valueList = array();
  foreach($_POST as $key=>$value){
    array_push($keyList, $key);
    array_push($valueList, $value);
  } 

  $size = sizeof($keyList);

  for($i = 0; $i < ($size); $i++){
    if(strpos($keyList[$i], "mc") != false){
      if($post == null)
        $post = $i . "mc=" . $valueList[$i];
      else
        $post = $post . "&" . $i . "mc=" . $valueList[$i];
    }
    else if(strpos($keyList[$i], "fitb") != false){
      if($post == null)
        $post = $i . "fitb=" . $valueList[$i];
      else
        $post = $post . "&" . $i . "fitb=" . $valueList[$i];
    }
    else if(strpos($keyList[$i], "tf") != false){
      if($post == null)
        $post = $i . "tf=" . $valueList[$i];
      else
        $post = $post . "&" . $i . "tf=" . $valueList[$i];
    }
    else if(strpos($keyList[$i], "oe") != false){
      if($post == null)
        $post = $i . "oe=" . $valueList[$i];
      else
        $post = $post . "&" . $i . "oe=" . $valueList[$i];
    }
  }
  
  $url = "https://web.njit.edu/~edm8/cs490/Back/backRemoveQuestion.php";
  
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, TRUE);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  $response = curl_exec($ch);
  curl_close($ch);
  echo $response;
?>