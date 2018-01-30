<?php
$servername = "sql.njit.edu";
$user = $_POST['Username'];

//creates connection to mysql
$conn = new mysqli($servername, $username, $password, $db);

//checks connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

//$sql = "insert into cs490 values('$name', '$hash_password')";
$sql = "SELECT * FROM Exams 
        INNER JOIN ExamResults 
        WHERE Exams.examName = ExamResults.examName 
        AND Exams.releaseGrades=1";
//echo $sql;
$result = $conn->query($sql);
$conn->close();

$counter = 0;
$examArray = array();
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $examArray[$counter]= $row["examName"];
        $counter++;
    }
} else {
    echo "0 results";
}

echo json_encode($examArray);
?>