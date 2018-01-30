<?php
$examName = $_POST['examName'];
$user = $_POST['Username'];
$servername = "sql.njit.edu";

//creates connection to mysql
$conn = new mysqli($servername, $username, $password, $db);

//checks connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "UPDATE Exams SET releaseGrades=1 WHERE examName='$examName'";
$conn->query($sql);

$conn->close();
?>