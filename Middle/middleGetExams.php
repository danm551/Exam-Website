<?php
//$url = "https://web.njit.edu/~edm8/cs431/Middle/middleReg.php";
//$url = "localhost/cs431/Middle/middleReg.php";
//$url = "localhost/cs490/Back/backGetExams.php";
$url = "https://web.njit.edu/~edm8/cs490/Back/backGetExams.php";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$result = curl_exec($ch);
curl_close($ch);

$resultArray = json_decode($result,true);
echo json_encode($resultArray);
?>