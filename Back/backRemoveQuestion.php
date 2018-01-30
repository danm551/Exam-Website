<?php
  //echo "HERE";
  //echo print_r($_POST);
  $servername = "sql.njit.edu";
  $examName = $_POST['examName'];
  
  $conn = new mysqli($servername, $username, $password, $db);
  if ($conn->connect_error){
      die("Connection failed: " . $conn->connect_error);
  } 
  
  //builds arrays of keys and values from $_POST
  $keyList = array();
  $valueList = array();
  foreach($_POST as $key=>$value){
    array_push($keyList, $key);
    array_push($valueList, $value);
  } 
  
  //builds questionList and points pointsList
  $size = sizeof($keyList);
  for($i = 0; $i < $size; $i++){
    if(strpos($keyList[$i], "mc") != false){
        $sql = "DELETE FROM mcQuestions WHERE id='$valueList[$i]'";
        $conn->query($sql);
    }
    else if(strpos($keyList[$i], "fitb") != false){
        $sql = "DELETE FROM fitbQuestions WHERE id='$valueList[$i]'";
        $conn->query($sql);
    }
    else if(strpos($keyList[$i], "tf") != false){
        $sql = "DELETE FROM tfQuestions WHERE id='$valueList[$i]'";
        $conn->query($sql);
    }
    else if(strpos($keyList[$i], "oe") != false){
        $sql = "DELETE FROM oeQuestions WHERE id='$valueList[$i]'";
        $conn->query($sql);
    }
  }
  
  $conn->close();
?>