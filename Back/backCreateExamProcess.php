<?php
  //echo print_r($_POST);
  $servername = "sql.njit.edu";
  $examName = $_POST['examName'];
  
  //builds arrays of keys and values from $_POST
  $keyList = array();
  $valueList = array();
  foreach($_POST as $key=>$value){
    array_push($keyList, $key);
    array_push($valueList, $value);
  } 
  
  //deletes examName, only question values left
  array_pop($keyList);
  array_pop($valueList);
  
  //builds questionList and points pointsList
  $questionList = null;
  $pointsList = null;
  $size = sizeof($keyList);
  for($i = 0; $i < $size; $i++){
    if(strpos($keyList[$i], "mc") != false){
      if($questionList == null)
        $questionList = "mc" . $valueList[$i];
      else
        $questionList = $questionList . ",mc" . $valueList[$i];
    }
    else if(strpos($keyList[$i], "fitb") != false){
      if($questionList == null)
        $questionList = "fitb" . $valueList[$i];
      else
        $questionList = $questionList . ",fitb" . $valueList[$i];
    }
    else if(strpos($keyList[$i], "tf") != false){
      if($questionList == null)
        $questionList = "tf" . $valueList[$i];
      else
        $questionList = $questionList . ",tf" . $valueList[$i];
    }
    else if(strpos($keyList[$i], "oe") != false){
      if($questionList == null)
        $questionList = "oe" . $valueList[$i];
      else
        $questionList = $questionList . ",oe" . $valueList[$i];
    }
    else
      $pointsList = $pointsList . $valueList[$i] . " ";

  }
  
  //echo $questionList;
  
  //creates connection to mysql
  $conn = new mysqli($servername, $username, $password, $db);
  
  //checks connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  } 
  
  $sql = "INSERT INTO Exams(examName, questions, points) VALUES('$examName', '$questionList', '$pointsList')";
  //echo $sql;
  $conn->query($sql);
  
  $conn->close();
?>