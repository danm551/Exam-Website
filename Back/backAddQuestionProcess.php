<?php
  $qType = $_POST['qType'];
  $comm = $_POST['comm'];
  //mc fields
  $question = $_POST['question'];
  $answer1 = $_POST['answer1'];
  $answer2 = $_POST['answer2'];
  $answer3 = $_POST['answer3'];
  $answer4 = $_POST['answer4'];
  $answer5 = $_POST['answer5'];
  //oe fields
  $funcName = $_POST['funcName'];
  $returns = $_POST['returns'];
  $args = $_POST['args'];
  $arg1 = $_POST['arg1'];
  $arg2 = $_POST['arg2'];
  $arg3 = $_POST['arg3'];
  $arg4 = $_POST['arg4'];
  $type1 = $_POST['type1'];
  $type2 = $_POST['type2'];
  $type3 = $_POST['type3'];
  $type4 = $_POST['type4'];
  
  $servername = "sql.njit.edu";
  
  //creates connection to mysql
  $conn = new mysqli($servername, $username, $password, $db);
  
  //checks connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  } 
  
  //$sql = "insert into cs490 values('$name', '$hash_password')";
  if($qType == "mc"){
    $sql = "INSERT INTO mcQuestions(Type, Question, CorrectAnswer, Answer2, Answer3, Answer4, Answer5, Comment) VALUES(\"$qType\",\"$question\",\"$answer1\",\"$answer2\",\"$answer3\",\"$answer4\",\"$answer5\",\"$comm\")";
  }
  else if($qType == "fitb"){
    $sql = "INSERT INTO fitbQuestions(Type, Question, CorrectAnswer, Comment) VALUES(\"$qType\",\"$question\",\"$answer1\",\"$comm\")";
  }
  else if($qType == "tf"){
    $sql = "INSERT INTO tfQuestions(Type, Question, CorrectAnswer, Comment) VALUES(\"$qType\",\"$question\",\"$answer1\",\"$comm\")";
  }
  else if($qType == "oe"){
    $sql1 = "INSERT INTO oeQuestions(Type, FuncName, Args, Question, Returns"; 
    $sql2 = " VALUES(\"$qType\", \"$funcName\", \"$args\", \"$question\", \"$returns\"";
    for($i = 0; $i < 5; $i++){
  	    if($_POST['arg' . $i]){
          $sql1 = $sql1 . ", Arg" . $i;
          $sql2 = $sql2 . ", \"" . str_replace("\"", "'",$_POST['arg' . $i]) . "\"";
      	}
    }
    for($i = 0; $i < 5; $i++){
  	    if($_POST['arg' . $i]){
          $sql1 = $sql1 . ", Type" . $i;
          $sql2 = $sql2 . ", \"" . $_POST['type' . $i] . "\"";
      	}
    }
    $sql1 = $sql1 . ", Answer1)";
    $sql2 = $sql2 . ", \"" . $answer1 . "\")";
    $sql = $sql1. $sql2;
  }

  $conn->query($sql);
  
  $conn->close();
?>