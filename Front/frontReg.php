<?php
if(!empty($_POST['Username'] && $_POST['Password'])){
  $name = $_POST['Username'];
  $pass = $_POST['Password'];
  $accType = $_POST['accType'];
  $post = 'name='.$name.'&pass='.$pass.'&account='.$accType;
  //$url = "https://web.njit.edu/~edm8/cs490/Middle/middleReg.php";
  $url = "https://web.njit.edu/~tkt6/cs490/Middle/middleReg.php";
  //$url = "https://web.njit.edu/~edm8/cs490/Middle/middleReg.php";
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

  if($response == 1){
    echo "Account has been created."."<br>";
    //header("Location:https://web.njit.edu/~edm8/cs431/Front/frontWelcome.php"); //redirects to Login
    //exit();
  }
  else
    echo "<font color='red'>"."The username is already taken. Please select a different username."."</font>"."<br>";
}
else
  echo "<font color='red'>"."Username and Password must be set."."</font>"
?>