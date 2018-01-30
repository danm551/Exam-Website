<?php
$servername = "sql.njit.edu";
$examName = $_POST['examName'];

//creates connection to mysql
$conn = new mysqli($servername, $username, $password, $db);

//checks connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$resultArray = array();

//$sql = "insert into cs490 values('$name', '$hash_password')";
$sql = "SELECT answers FROM ExamResults WHERE examName='$examName'";
//echo $sql;
$result = $conn->query($sql);

$row = mysqli_fetch_assoc($result);
$answers = $row["answers"];

//inserts question numbers into an array
$pattern = '/[^%&&%]+/';
preg_match_all($pattern, $answers, $match);
$matchArray = $match[0];

//gathers indeces for correct answers
$sql = "SELECT correct FROM ExamResults WHERE examName='$examName'";
$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result);
$correctTemp = $row["correct"];
$correct = explode(" ", $correctTemp);

//gathers indeces for wrong answers
$sql = "SELECT wrong FROM ExamResults WHERE examName='$examName'";
$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result);
$wrongTemp = $row["wrong"];
$wrong = explode(" ", $wrongTemp);

//gathers indeces for output
$sql = "SELECT output FROM ExamResults WHERE examName='$examName'";
$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result);
$outputTemp = $row["output"];
$output = explode("%&&%", $outputTemp);

//gathers point values for output
$sql = "SELECT points FROM Exams WHERE examName='$examName'";
$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result);
$outputTemp = $row["points"];
$scores = explode(" ", $outputTemp);

//removes null values
$scores = array_filter($scores);
$correct = array_filter($correct);
$wrong = array_filter($wrong);

//converts to string
$scores = implode(" ", $scores);
$correct = implode(" ", $correct);
$wrong = implode(" ", $wrong);

//rearranges as array (ultimately fixing the problem with indices not being correct)
$scores = explode(" ", $scores);
$correct = explode(" ", $correct);
$wrong = explode(" ", $wrong);

$resultArray[0] = $matchArray;
$resultArray[1] = $correct;
$resultArray[2] = $wrong;
$resultArray[3] = $output;
$resultArray[4] = $scores;

$conn->close();

echo json_encode($resultArray);
?>