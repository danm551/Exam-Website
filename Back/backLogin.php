<?php
$name = $_POST['name'];
$pass = $_POST['pass'];
$servername = "sql.njit.edu";

//creates connection to mysql
$conn = new mysqli($servername, $username, $password, $db);

//checks connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

//hashes password using php library function
$hash_password = password_hash($pass, PASSWORD_DEFAULT);

//$sql = "insert into cs490 values('$name', '$hash_password')";
$sql = "SELECT pass FROM Users WHERE name='$name'";
//echo $sql;

$result = $conn->query($sql);
//fetches database password attached to username
$row = mysqli_fetch_assoc($result);
$db_pass = $row["pass"];

//verifies the hashed password -- returns true or false
$ispasswordcorrect = password_verify($pass, $db_pass);
//logic for return to middle
if(!$ispasswordcorrect)
	$reply = 0;
else
	$reply = 1;

//echo json_encode($reply);

//block that checks and returns account type
$sql = "SELECT type FROM Users WHERE name='$name'";
$result = $conn->query($sql);
//$result = $dbh->prepare("SELECT type FROM Users WHERE name=?");//parametarized syntax, not working yet
//$result->execute(array($name));
$row = mysqli_fetch_assoc($result);
$db_type = $row["type"];
$type_match = strcmp($db_type, "faculty");
if($type_match == false)
    $type = "t";
else
    $type = "s";

echo json_encode($reply.$type);


$conn->close();
?>