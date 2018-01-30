<?php
$name = $_POST['name'];
$pass = $_POST['pass'];
$accType = $_POST['account'];
$servername = "sql.njit.edu";
//echo $accType;
//creates connection to mysql
$conn = new mysqli($servername, $username, $password, $db);

//checks connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

//hashes password using php library function
$hash_password = password_hash($pass, PASSWORD_DEFAULT);

//$sql = "insert into cs490 values('$name', '$hash_password')";
$sql = "SELECT * FROM Users WHERE name='$name'";
//echo $sql;

$result = $conn->query($sql);
if ($result->num_rows > 0){ 
  $reply = 0;
}
else{
//fetches database password attached to username
  $sql = "INSERT INTO Users VALUES('$name', '$hash_password', '$accType')";
  //echo $sql;
  $conn->query($sql);
  $reply = 1;
}

echo json_encode($reply);

$conn->close();
?>