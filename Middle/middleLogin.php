<?php
$name = $_POST['name'];
$pass = $_POST['pass'];

//call to back
$post = 'name='.$name.'&pass='.$pass;
$url = "https://web.njit.edu/~edm8/cs490/Back/backLogin.php";
//$url = "https://web.njit.edu/~edm8/cs490/Back/backLogin.php"; 
//$url = "localhost/cs431/Back/backLogin.php";
//$url = "localhost/cs490/Back/backLogin.php";
//echo $post;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
$response = curl_exec($ch);
//echo strlen($response);
curl_close($ch);
//echo $response;
echo json_decode($response);
?>