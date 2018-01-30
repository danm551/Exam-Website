<?php
$examName = $_POST['examName'];
$correct = $_POST['correct'];
$wrong = $_POST['wrong'];
$user = $_POST['Username'];
$servername = "sql.njit.edu";

//creates connection to mysql
$conn = new mysqli($servername, $username, $password, $db);

//checks connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$counter = 1;
$answers = null;
while(isset($_POST[$counter])){
    if($answers == null)
        $answers = $_POST[$counter];
    else
        $answers = $answers."%&&%".$_POST[$counter];
    $counter++;
}

$size = sizeof($_POST);
$outputString = null;
for($i = 0; $i < $size; $i++){
  if($_POST['output' . $i])
    if($outputString == null)
      $outputString = $_POST['output' . $i];
    else
      $outputString = $outputString . "%&&%" . $_POST['output' . $i];
}   
  
$sql = "INSERT INTO ExamResults VALUES('$user', '$examName', '$answers', '$correct', '$wrong', '$outputString')";
//echo $sql;
$conn->query($sql);

$sql = "UPDATE Exams SET taken=1 WHERE examName='$examName'";
$conn->query($sql);

$conn->close();
?>