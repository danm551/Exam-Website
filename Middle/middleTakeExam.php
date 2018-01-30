<?php
    $examName = $_POST['examName'];
    $post = "examName=".$examName;
    $url = "https://web.njit.edu/~edm8/cs490/Back/backTakeExam.php";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $result = curl_exec($ch);
    //echo $result;
    curl_close($ch);

    $resultArray = json_decode($result,true);
    echo json_encode($resultArray);
?>