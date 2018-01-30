<?php
$url = "https://web.njit.edu/~edm8/cs490/Back/backGetQuestions.php";

$qType = $_POST['qType'];
$post = "qType=" . $qType;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$result = curl_exec($ch);
curl_close($ch);

$resultArray = json_decode($result,true);
echo json_encode($resultArray);
?>