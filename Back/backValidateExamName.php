<?php
$examName = $_POST['examName'];
$servername = "sql.njit.edu";

//creates connection to mysql
$conn = new mysqli($servername, $username, $password, $db);

//checks connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
  
$sql = "SELECT examName FROM Exams WHERE examName='$examName'";
$result = $conn->query($sql);

if($result->num_rows > 0)
  $reply = 1;
else
  $reply = 0;

$conn->close();

echo json_encode($reply);
?>