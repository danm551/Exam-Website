<?php
  $examName = $_POST['examName'];
  //$url = "https://web.njit.edu/~edm8/cs490/Middle/middleReleaseProcess.php";
  $url = "https://web.njit.edu/~tkt6/cs490/Middle/middleReleaseProcess.php";
  //$url = "https://web.njit.edu/~edm8/cs490/Middle/middleReleaseProcess.php";
  $post = "examName=".$examName;
  //$url = "localhost/cs431/Middle/middleReg.php";
  //$url = "localhost/cs490/Middle/middleReg.php";
  
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, TRUE);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE); 
  $response = curl_exec($ch);
  curl_close($ch);
  //echo $response;
  
  header("Location:https://web.njit.edu/~edm8/cs490/Front/frontWelcomeTeacher.php");
?>