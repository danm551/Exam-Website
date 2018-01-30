<?php
  //echo print_r($_POST);
  $examName = $_POST['examName'];
  $qNumber = $_POST['qNumber'];
  
  $keyList = array();
  $valueList = array();
  foreach($_POST as $key=>$value){
    array_push($keyList, $key);
    array_push($valueList, $value);
  } 
  
  //removes first two elems and last elem for each list (examName, qNumber)
  array_shift($keyList);
  array_shift($keyList);
  array_shift($valueList);
  array_shift($valueList);
  
  //echo print_r($keyList);

  $size = sizeof($keyList);

  for($i = 0; $i < ($size/2); $i++){
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
  
  $j = 0;
  for($i = ($size/2); $i < $size; $i++){
    $post = $post . "&score" . $j . "=" . $valueList[$i];
    $j++;
  }
  
  

  $post = $post . "&examName=" . $examName;
  //echo "post: " . $post;
  
  $url = "https://web.njit.edu/~edm8/cs490/Back/backCreateExamProcess.php";
  
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, TRUE);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  $response = curl_exec($ch);
  curl_close($ch);
  echo $response;
?>