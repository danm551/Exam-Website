<?php
    session_start();
    if(isset($_SESSION['Username'])){
    }
    else{
        header("Location:https://web.njit.edu/~edm8/cs490/Front/login.html");
        exit;
    }
?>

<?php
    //echo print_r($_POST);
    //echo print_r($_SESSION);
    $qCount = $_POST['qCount'];
    $counter = 1;
    $post = null;
    
    //$post construction - user answers
    for($i = 1; $i <= $qCount; $i++){
      if(isset($_POST[$i])){
        if($post == null)
            $post = $i."=".urlencode($_POST[$i]);
        else
            $post = $post."&".$i."=".urlencode($_POST[$i]);
      }
    }

    //$post construction - user answers - open ended
    for($i = 1; $i <= $qCount; $i++){
      if(isset($_POST['oe' . $i])){
          if($post == null)
              $post = "oe".$i."=". urlencode($_POST['oe' . $i]);
          else
              $post = $post."&oe".$i."=". urlencode($_POST['oe' . $i]); //using URLENCODE to circumvent the default processing of '+' sign and other special characters by the browser
      }
    }
     
    //$post construction - correct answers
    for($i = 1; $i <= $qCount; $i++){
      if($_SESSION['answer' . $i] != null)
        $answers = $answers . "&answer" . $i . "=" . $_SESSION['answer' . $i];
      $counter++;
    }
 
    //$post construction - correct answers - open ended
    for($i = 1; $i <= $qCount; $i++){
      if($_SESSION['oe-answer' . $i] != null)
        $answers = $answers . "&oe-answer" . $i . "=" . $_SESSION['oe-answer' . $i];
    }
    
    //$post contruction - open ended arguments
    for($i = 1; $i < $qCount; $i++){
      for($j = 1; $j < 5; $j++)
      if($_POST['arg' . $j . '-' . $i]){
        $args = $args . "&arg" . $j . "-" . $i . "=" . $_POST['arg' . $j . '-' . $i];
      }
    }
    
    //$post contruction - open ended argument types
    for($i = 1; $i < $qCount; $i++){
      for($j = 1; $j < 5; $j++)
      if($_POST['type' . $j . '-' . $i]){
        $types = $types . "&type" . $j . "-" . $i . "=" . $_POST['type' . $j . '-' . $i];
      }
    }
 
    //$post construction - open ended function names
    for($i = 1; $i < $qCount; $i++){
      if($_POST['oe-funcName' . $i]){
        $funcNames = $funcNames . "&funcName" . $i . "=" . $_POST['oe-funcName' . $i];
      }
      if($_POST['returns' . $i]){
        $returns = $returns . "&returns" . $i . "=" . $_POST['returns' . $i];
      }
    }
    
    $post = $post."&examName=".$_POST['examName']."&Username=".$_SESSION['Username'] .$answers;
    $post = $post.$args.$types.$funcNames.$returns;
    $post = $post."&qCount=".$qCount;
    echo $post . "<br>";
    
    //$url = "https://web.njit.edu/~edm8/cs490/Middle/middleTakeExamProcess.php";
    $url = "https://web.njit.edu/~tkt6/cs490/Middle/middleTakeExamProcess.php";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE); 
    $response = curl_exec($ch);
    curl_close($ch);
    //echo $response; 

    header("Location:https://web.njit.edu/~edm8/cs490/Front/frontWelcomeStudent.php");
?>

<?php
    session_destroy();
?>