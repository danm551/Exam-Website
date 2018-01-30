<?php
    //echo print_r($_POST);
    function oeQuestionEval($code, $oeArrayOfCodeElements){
      error_reporting(E_ALL | E_STRICT);
      ini_set('display_errors',1);
      ini_set('display_startup_errors',1);
      error_reporting(-1);
      
      //code
      $argFunction = "(";
      for($i = 1; $i <= $oeArrayOfCodeElements["ArgCount"]; $i++){
        $temp = explode("=", $oeArrayOfCodeElements["Arg" . $i]);
      
        $argString = $argString . " " . $oeArrayOfCodeElements["Type" . $i] . " " . $oeArrayOfCodeElements["Arg" . $i] . ";";
        if($i == 1)
          $argFunction = $argFunction . $temp[0];
        else
          $argFunction = $argFunction . ", " . $temp[0];
      }
      $argFunction = $argFunction . ")";
      
      $compile_code="public class testProg{ public static void main (String[] args){ " . $argString . " " . $oeArrayOfCodeElements["Returns"] . " result; result=" . $oeArrayOfCodeElements["FuncName"] . $argFunction . "; System.out  .println(result);}".$code. "}";
      //echo $compile_code . "<br>";
      file_put_contents('/afs/cad.njit.edu/u/e/d/edm8/public_html/cs490/Middle/testProg.java',$compile_code);
      
      //compiles the code
      $error = shell_exec("javac /afs/cad.njit.edu/u/e/d/edm8/public_html/cs490/Middle/testProg.java 2>&1");
      
      //runns the code
      $output = exec("java -cp /afs/cad.njit.edu/u/e/d/edm8/public_html/cs490/Middle/ testProg 2>&1"); //2(stderror)>(output)&1(to stdout)
      //echo $output ."<br>";
      
      if ($error==null){
        return $output;
      }else{
        return 0; //$error
      }
    }
    
    $qCount = $_POST['qCount'];
    $post = null;
    $answerArray = array();
    $correctList = "&correct= ";
    $wrongList = "&wrong= ";
    //grades the non-open-ended answers and creates user answer $post
    for($i = 1; $i <= $qCount; $i++){
      if(isset($_POST[$i])){
          $userAnswer = trim($_POST[$i]);
          $realAnswer = trim($_POST['answer'.$i]);
          
          if(!strcasecmp($userAnswer, $realAnswer)){
              $correctList = $correctList . " " . $i;
          }
          else{
              $wrongList = $wrongList . " " . $i;
          }
          
          $post = $post . "&" . $i . "=" . urlencode($_POST[$i]);
      }
    }
    
    //creates array for user answers to the open ended questions
    $oeAnswerArray = array();
    for($i = 1; $i <= $qCount; $i++){
      if(isset($_POST['oe' . $i])){
          //creates array for open ended answers
          if(!$oeAnswerArray)
            $oeAnswerArray[0] = ($_POST['oe' . $i]);
          else
            array_push($oeAnswerArray, $_POST['oe' . $i]);
          //creates post for back end
          $post = $post."&".$i."=". urlencode($_POST['oe' . $i]);
      }
    }
    
    //builds an array of elements needed to build code block (args and their types)
    //foreach($_POST as $field => $value)
     //echo $field . $value . "<br>";
    $size = sizeof($_POST);
    $oeArrayOfCodeElements = array();
    for($i = 1; $i < $size; $i++){
      $tempArray = array();
      
      if($_POST['funcName' . $i]){
        $argCount = 0;
        
        if($_POST['funcName' . $i]){
          $tempArray["FuncName"] = $_POST['funcName' . $i];
          $tempArray["Number"] = $i;
          $tempArray["Answer"] = $_POST['oe-answer' . $i];
        }
        if($_POST['arg1-' . $i]){
          $tempArray["Arg1"] = $_POST['arg1-' . $i];
          $argCount++;
        }
        if($_POST['arg2-' . $i]){
          $tempArray["Arg2"] = $_POST['arg2-' . $i];
          $argCount++;
        }
        if($_POST['arg3-' . $i]){
          $tempArray["Arg3"] = $_POST['arg3-' . $i];
          $argCount++;
        }
        if($_POST['arg4-' . $i]){
          $tempArray["Arg4"] = $_POST['arg4-' . $i];
          $argCount++;
        }
        
        if($_POST['returns' . $i]){
          $tempArray["Returns"] = $_POST['returns' . $i];
        }
          
        if($_POST['type1-' . $i])
          $tempArray["Type1"] = $_POST['type1-' . $i];
        if($_POST['type2-' . $i])
          $tempArray["Type2"] = $_POST['type2-' . $i];
        if($_POST['type3-' . $i])
          $tempArray["Type3"] = $_POST['type3-' . $i];
        if($_POST['type4-' . $i])
          $tempArray["Type4"] = $_POST['type4-' . $i];
          
        $tempArray["ArgCount"] = $argCount;
        
        array_push($oeArrayOfCodeElements, $tempArray);
      }
    }

    //builds correct/wrong list for open-ended
    $counter2 = 0;
    $counter = 0;
    $args = array();
    $index = 0;
    //echo "OEAnswers: " . print_r($oeAnswerArray) . "<br>";
    foreach($oeAnswerArray as $code){
      $result = oeQuestionEval($code, $oeArrayOfCodeElements[$index]);
      $result = trim($result);
      //echo $result . "<br>";
      $realAnswer = trim($oeArrayOfCodeElements[$index]["Answer"]);
      if($result && !strcasecmp($result, $realAnswer)){
        $correctList = $correctList . " " . $oeArrayOfCodeElements[$index]["Number"];
        $post = $post."&output" . $oeArrayOfCodeElements[$index]["Number"] . "=" . $result;
      }
      else if($result && strcasecmp($result, $realAnswer)){
         $wrongList = $wrongList . " " . $oeArrayOfCodeElements[$index]["Number"];
         $post = $post."&output" . $oeArrayOfCodeElements[$index]["Number"] . "=" . "output mismatch";
      }
      else{
        $wrongList = $wrongList . " " . $oeArrayOfCodeElements[$index]["Number"];
        $post = $post."&output" . $oeArrayOfCodeElements[$index]["Number"] . "=" . "bad compile";
      }

      $counter++;
      $counter2++;
      $index++;
    }

    $graded = $correctList . $wrongList;
    $post = "examName=".$_POST['examName']."&Username=".$_POST['Username'] . $post;
    $post = $post . $graded;
    echo $post . "<br>";
    
    $url = "https://web.njit.edu/~edm8/cs490/Back/backTakeExamProcess.php";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE); 
    $response = curl_exec($ch);
    curl_close($ch);
    echo $response;
    
?>