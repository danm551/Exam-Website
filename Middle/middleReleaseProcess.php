<?php
  $examName = $_POST['examName'];
  $post = "examName=".$examName;
  //$url = "https://web.njit.edu/~edm8/cs431/Middle/middleReg.php";
  //$url = "localhost/cs431/Middle/middleReg.php";
  //$url = "localhost/cs490/Back/backGetExams.php";
  $url = "https://web.njit.edu/~edm8/cs490/Back/backReleaseProcess.php";
  
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, TRUE);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE); 
  $result = curl_exec($ch);
  curl_close($ch);
?>