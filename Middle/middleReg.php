<?php
$name = $_POST['name'];
$pass = $_POST['pass'];
$accType = $_POST['account'];
//call to back
$post = 'name='.$name.'&pass='.$pass.'&account='.$accType;
//$url = "https://web.njit.edu/~edm8/cs431/Back/backReg.php"; 
//$url = "localhost/cs431/Back/backReg.php";
//$url = "localhost/cs490/Back/backReg.php";
$url = "https://web.njit.edu/~edm8/cs490/Back/backReg.php";
//echo $post;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
$response = curl_exec($ch);
curl_close($ch);
//echo $response;
echo json_decode($response);
?>