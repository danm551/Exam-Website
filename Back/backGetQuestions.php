<?php
$servername = "sql.njit.edu";
$qType = $_POST['qType'];

//creates connection to mysql
$conn = new mysqli($servername, $username, $password, $db);

//checks connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

//$sql = "insert into cs490 values('$name', '$hash_password')";
$sql = "SELECT Question, id FROM " . $qType . "Questions";
$result = $conn->query($sql);
$conn->close();

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $questionArray[$row["id"]] = $row["Question"];
    }
} else {
    echo "0 results";
}

echo json_encode($questionArray);
?>