<?php

$userName = $_POST['Username'];
$post = "Username=".$userName;
//$url = "https://web.njit.edu/~edm8/cs431/Middle/middleReg.php";
//$url = "localhost/cs431/Middle/middleReg.php";
//$url = "localhost/cs490/Back/backGetUserExams.php";
$url = "https://web.njit.edu/~edm8/cs490/Back/backGetUserExams.php";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$result = curl_exec($ch);
curl_close($ch);
//echo $result;

$resultArray = json_decode($result,true);
echo json_encode($resultArray);
?>