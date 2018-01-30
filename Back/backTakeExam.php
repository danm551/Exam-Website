<?php
  $servername = "sql.njit.edu";
  $examName = $_POST['examName'];
  //$qTypeArray = array("mc", "fitb", "tf", "oe");
  
  //creates connection to mysql
  $conn = new mysqli($servername, $username, $password, $db);
  
  //checks connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  } 
  
  $sql = "SELECT id FROM Exams WHERE examName='$examName'";

  $result = $conn->query($sql);
  $row = mysqli_fetch_assoc($result);
  $examId = $row["id"];
  
  $sql = "SELECT questions FROM Exams WHERE id='$examId'";
  $result = $conn->query($sql);
  $row = mysqli_fetch_assoc($result);
  $questionsList = $row["questions"];

  $pattern = '/[a-zA-Z]+[0-9]+/';
  preg_match_all($pattern, $questionsList, $match);
  $matchArray = $match[0];

  //build $typeArray wich holds the question types and $idArray which holds question IDs
  $size = sizeof($matchArray);
  for($i = 0; $i < $size; $i++){
    if(strpos($matchArray[$i], "mc") === 0){
      $temp = str_replace("mc", "", $matchArray[$i]);
      $typeArray[$i] = "mc";
      $idArray[$i] = $temp;
    }
    else if(strpos($matchArray[$i], "fitb") === 0){
      $temp = str_replace("fitb", "", $matchArray[$i]);
      $typeArray[$i] = "fitb";
      $idArray[$i] = $temp;
    }
    else if(strpos($matchArray[$i], "tf") === 0){
      $temp = str_replace("tf", "", $matchArray[$i]);
      $typeArray[$i] = "tf";
      $idArray[$i] = $temp;
    } 
    else if(strpos($matchArray[$i], "oe") === 0){
      $temp = str_replace("oe", "", $matchArray[$i]);
      $typeArray[$i] = "oe";
      $idArray[$i] = $temp;
    }
  }
  
  $questionArray = array();
    //creates an array of the questions/answers
    for($i = 0; $i < $size; $i++){
        $temp = array();
        $sql = "SELECT * FROM " . $typeArray[$i] . "Questions WHERE id='$idArray[$i]'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        $type = $row["Type"];
            if($type == "mc"){
                $temp["Type"] = $row['Type'];
                $temp["Question"] = $row['Question'];
                $temp["CorrectAnswer"] = $row['CorrectAnswer'];
                $temp["Answer2"] = $row['Answer2'];
                $temp["Answer3"] = $row['Answer3'];
                $temp["Answer4"] = $row['Answer4'];
                $temp["Answer5"] = $row['Answer5'];
                $temp["Comment"] = $row['Comment'];
            }
            else if($type == "fitb"){
                $temp["Type"] = $row['Type'];
                $temp["Question"] = $row['Question'];
                $temp["CorrectAnswer"] = $row['CorrectAnswer'];
                $temp["Comment"] = $row['Comment'];
            }
            else if($type == "tf"){
                $temp["Type"] = $row['Type'];
                $temp["Question"] = $row['Question'];
                $temp["CorrectAnswer"] = $row['CorrectAnswer'];
                $temp["Comment"] = $row['Comment'];
            }
            else{
                $temp["Type"] = $row['Type'];
                $temp["Question"] = $row['Question'];
                $temp["CorrectAnswer"] = $row['Answer1'];
                $temp["FuncName"] = $row['FuncName'];
                $temp["Comment"] = $row['Comment'];
                $temp["Returns"] = $row['Returns'];

                if($row['Type1'])
                  $temp["Type1"] = $row['Type1'];
                if($row['Type2'])
                  $temp["Type2"] = $row['Type2'];
                if($row['Type3'])
                  $temp["Type3"] = $row['Type3'];
                if($row['Type4'])
                  $temp["Type4"] = $row['Type4'];
                if($row['Arg1'])
                  $temp["Arg1"] = $row['Arg1'];
                if($row['Arg2'])
                  $temp["Arg2"] = $row['Arg2'];
                if($row['Arg3'])
                  $temp["Arg3"] = $row['Arg3'];
                if($row['Arg4'])
                  $temp["Arg4"] = $row['Arg4'];
            }
            
            array_push($questionArray, $temp);
            //print_r($questionArray);
    }
  $conn->close();
  
  echo json_encode($questionArray);
?>