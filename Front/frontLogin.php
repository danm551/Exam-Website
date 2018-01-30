<?php
session_start();
//call to middle
if(!empty($_POST['Username'] && $_POST['Password'])){
  $name = $_POST['Username'];
  $pass = $_POST['Password'];
  $post = 'name='.$name.'&pass='.$pass;
  //$url = "https://web.njit.edu/~edm8/cs490/Middle/middleLogin.php";
  $url = "https://web.njit.edu/~tkt6/cs490/Middle/middleLogin.php";
  
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, TRUE);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
  $response = curl_exec($ch);
  curl_close($ch);
  //echo $response;

  if($response[0] == 1){
    $_SESSION['Username'] = $name;
    $type_match = strcmp($response[1], "s");
    if(!$type_match){
        header("Location:https://web.njit.edu/~edm8/cs490/Front/frontWelcomeStudent.php");
        exit;
    }
    else{
        header("Location:https://web.njit.edu/~edm8/cs490/Front/frontWelcomeTeacher.php");
        exit;
    }
  }
  else{
    echo "<font color='red'>"."The username and/or password is not correct."."</font>"."<br>";
  }
}
else
  echo "<font color='red'>"."Username and Password must be set."."</font>"
?>