<?php
    /*session_start();
    if(isset($_SESSION['Username'])){
    }
    else{
        header("Location:http://localhost/cs431/Front/login.html");
        exit;
    }*/
?>
<!DOCTYPE HTML>
<html>
<link rel="stylesheet" href="style.css">
<link href='https://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Crete+Round' rel='stylesheet' type='text/css'>
    <script>
      function allowDrop(ev){
        ev.preventDefault();
      }
      function drag(ev){
        ev.dataTransfer.setData('text', ev.target.id);
      }
      function dropAdd(ev, id){
        //codex: "0mcquestion5" : 0 = place in exam list, mcquestion = mc type, 5 = id in mcQuestions table
        var data = ev.dataTransfer.getData('text');
        var list = 'list';
        var id = id;
        var doesItExist = document.getElementById(list.concat(data));
        var size = document.getElementById('root' + id).childNodes.length;
        
        //builds and adds hidden input elements (to add into $_POST) if the element doesn't exist
        if(doesItExist == null && size == 0){ 
          ev.preventDefault;
          ev.target.appendChild(document.getElementById(data));
          var num = data.match(/\d+/g);
        
          var node = document.createElement('INPUT');
          node.setAttribute('id', list.concat(data));
          node.setAttribute('name', id.concat(data));
          node.setAttribute('type', 'checkbox');
          node.setAttribute('value', num)
          node.setAttribute('hidden', true);
          node.setAttribute('checked', true);
          node.setAttribute('order', id);
          var parent = document.getElementById('root' + id);
          parent.appendChild(node);
        }
        else if(size != 0)
          alert("Only one question allowed per slot.");
        else
          alert("That question has already been selected.");
      } 
      function dropRemove(ev){
        ev.preventDefault;
        var data = ev.dataTransfer.getData('text');
        ev.target.appendChild(document.getElementById(data));
 
        //remove element when element leaves dropbox
        var list = 'list';
        var parent = document.getElementById('createExam');
        var child = document.getElementById(list.concat(data));
        parent.removeChild(child);
      }
      function getQuestions(type){
        var qType = 'qType=' + type;
        //deletes existing list
        var deleteChildren = document.getElementById("dropbox2");
        
        while(deleteChildren.firstChild){
          deleteChildren.removeChild(deleteChildren.firstChild);
        }
        //begins ajax procedure
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange =
        function(){
          if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
              var jsonObj = JSON.parse(xmlhttp.responseText); //parses the response into a JSON object
              
              var indexString = Object.keys(jsonObj); //makes a string of the JSON object indexes
              var indexArray = JSON.parse('[' + indexString + ']'); //turns the JSON indexes string into an array

              //adds the questions elements to the dropbox
              for(i = 0; i < indexArray.length; i++){
                var index = indexArray[i];

                var node = document.createElement('DIV');
                node.setAttribute('class', type + 'Div');
                node.setAttribute('id', type.concat(index));
                node.setAttribute('value', jsonObj[index]);
                node.setAttribute('ondragstart', 'drag(event)');
                node.setAttribute('ondragstart', 'drag(event)');
                node.setAttribute('draggable', 'true');
                
                node.innerHTML = jsonObj[index];
            
                var parent = document.getElementById('dropbox2');
                parent.appendChild(node);
              }
          }
          else{
              //document.getElementById('dropbox2').innerHTML = 'Waiting for server response!';
          }
        }
        
        //ajax syntax to send the POST
        //xmlhttp.open('POST', 'https://web.njit.edu/~edm8/cs490/Middle/middleGetQuestions.php', true);
        xmlhttp.open('POST', 'https://web.njit.edu/~tkt6/cs490/Middle/middleGetQuestions.php', true);
        xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xmlhttp.send(qType);
      }
      function getSearchQuestions(){
        while(1){
          var type = prompt("HelloEnter a question type:\n1: mc (multiple choice)\n2: fitb (fill in the blank)\n3: tf (true or false)\n4: oe (open-ended)");
          if(type.localeCompare("mc") == 0){
            break;
          }
          else if(type.localeCompare("fitb") == 0)
            break;
          else if(type.localeCompare("tf") == 0)
            break;
          else if(type.localeCompare("oe") == 0)
            break;
          else{
            confirm("Not a valid choice.");
          }
        }
        var key = prompt("Keyword to search:");
        var post = "keyword=" + key + "&qType=" + type;

        //deletes existing list
        var deleteChildren = document.getElementById("dropbox2");
        
        while(deleteChildren.firstChild){
          deleteChildren.removeChild(deleteChildren.firstChild);
        }
        //begins ajax procedure
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange =
        function(){
          if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
              //alert(xmlhttp.responseText)
              var jsonObj = JSON.parse(xmlhttp.responseText); //parses the response into a JSON object
              var indexString = Object.keys(jsonObj); //makes a string of the JSON object indexes
              var indexArray = JSON.parse('[' + indexString + ']'); //turns the JSON indexes string into an array
              
              

              //adds the questions elements to the dropbox
              for(i = 0; i < indexArray.length; i++){
                var index = indexArray[i];
                //alert(indexArray.length);
                //alert(index);

                var node = document.createElement('DIV');
                node.setAttribute('class', type + 'Div');
                node.setAttribute('id', type.concat(index));
                node.setAttribute('value', jsonObj[index]);
                node.setAttribute('ondragstart', 'drag(event)');
                node.setAttribute('ondragstart', 'drag(event)');
                node.setAttribute('draggable', 'true');
                
                node.innerHTML = jsonObj[index];
            
                var parent = document.getElementById('dropbox2');
                parent.appendChild(node);
              }
          }
          else{
              //document.getElementById('dropbox2').innerHTML = 'Waiting for server response!';
          }
        }
        
        //ajax syntax to send the POST
        //xmlhttp.open('POST', 'https://web.njit.edu/~edm8/cs490/Middle/middleGetQuestions.php', true);
        xmlhttp.open('POST', 'https://web.njit.edu/~tkt6/cs490/Middle/middleGetSearchQuestions.php', true);
        xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xmlhttp.send(post);
      }
      function addQuestions(){
      
        var temp = document.getElementById('qFrame');
        var array = temp.getElementsByTagName('P');
        lastRoot = array.length;
        
        
        var qNum = prompt("How many questions would you like to add?");
        var parent = document.getElementById('qFrame');
        var score = lastRoot;
        
        for(i = 0; i < qNum; i++){
          var bottom = 69*lastRoot-5;
          var newIndex = document.createElement('P');
          newIndex.setAttribute('class', 'qNumbers');
          newIndex.setAttribute('style', 'bottom: '+bottom+'px;');
          newIndex.innerHTML = (lastRoot+1 +'.');
          
          var newRoot = document.createElement('DIV');
          newRoot.setAttribute('id', 'root' + score);
          newRoot.setAttribute('hidden', true);
          
          var bottom2 = 69*(lastRoot+1)-7;
          var newDropBox = document.createElement('DIV');
          newDropBox.setAttribute('class', 'dropbox');
          newDropBox.setAttribute('id', 'dropbox');
          newDropBox.setAttribute('name', 'dropbox');
          newDropBox.setAttribute('ondragover', 'allowDrop(event)');
          newDropBox.setAttribute('ondrop', 'dropAdd(event, \"'+score+'\")');
          newDropBox.setAttribute('style', 'bottom: '+bottom2+'px;');
          
          var newBr = document.createElement('BR');
          
          var bottom3 = 69*(lastRoot+2)-13;
          var newScoreBox = document.createElement('INPUT');
          newScoreBox.setAttribute('class', 'scoreBox');
          newScoreBox.setAttribute('type', 'number');
          newScoreBox.setAttribute('name', 'score' + score);
          newScoreBox.setAttribute('style', 'bottom: '+bottom3+'px;');
          newScoreBox.setAttribute('min', '0');
          newScoreBox.setAttribute('max', '100');
          newScoreBox.setAttribute('value', '0');
          
          parent.appendChild(newIndex);      
          parent.appendChild(newRoot);
          parent.appendChild(newDropBox);
          parent.appendChild(newBr);
          parent.appendChild(newScoreBox);
          
          lastRoot++;
          score++;
        }
      }
    </script>
</html>

<?php
  
  //echo print_r($_POST);
  $examName = $_POST['examName'];
  $qNumber = $_POST['qNumber'];
  $response = $_POST['examValid'];

  if(!$examName){
    echo "<form id='examName' name='examName' method='post' action='frontCreateExam.php'> 
	          <p class='resultsText' style='margin-left: 30%; margin-top: 15%; font-size: 200%;'>Name your exam : <input class='textbox' type='text' name='examName' style='position: relative; left: 20px; bottom: 5px;' required></p>
	          <input class='createQuestionSubmit' type='submit' name='submit' value='Select' style='position: relative; left: 41%;'>
          </form>";
  }
  
    //block that validates exam name
    if($_POST['examName'] && !$_POST['submit2']){
      $post = "examName=" . $examName;
      //$url = "https://web.njit.edu/~edm8/cs490/Middle/middleValidateExamName.php";
      $url = "https://web.njit.edu/~tkt6/cs490/Middle/middleValidateExamName.php";
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_POST, TRUE);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
      $response = curl_exec($ch);
      curl_close($ch);
      
      if($response == 1){
        echo "<form id='examName' name='examName' method='post' action='frontCreateExam.php'> 
                <p class='resultsText' style='margin-left: 30%; margin-top: 15%; font-size: 200%;'>Name your exam : <input class='textbox' 
                  type='text' name='examName' style='position: relative; left: 20px; bottom: 5px;' required></p>
                <input  class='createQuestionSubmit' type='submit' name='submit' value='Select' style='position: relative; left: 41%;'>
              </form>";
        echo "<p class='resultsText' style='color: red; left: 34%; top: 50px; letter-spacing: 5px;'>That exam name is already taken.</p>";
        exit();
      }
    }

  
  if($_POST['examName'] && !$_POST['qNumber']){
    echo "<form id='qNumber' name='qNumber' method='post' action='frontCreateExam.php'> 
	          <p class='resultsText' style='margin-left: 23%; margin-top: 15%; font-size: 200%;'>How many question slots would you like to start with? : <input class='textbox' type='number' name='qNumber' min='1' max='50' 
              style='position: relative; left: 20px; bottom: 5px; width: 50px;'required></p>
              <input type='checkbox' name='examName' value='$examName' hidden checked>
	          <input class='createQuestionSubmit' type='submit' name='submit' value='Select' style='position: relative; left: 41%;'>
          </form>";
  }
  //$examName = "TEST"; //DELETE
  //$qNumber = 3; //DELETE
  if($_POST['examName'] && $_POST['qNumber']){
    echo "   <header>
	           <p class='poiretOne' style='font-size: 200%;'>CREATE EXAM</p>
             </header>
             <body>
             <div style='height: 100px;'>
             <div class='resultsText' style='left: 827px; top: 50px; font-size: 200%;'>SCORE</div>
             <div class='resultsText' style='left: 1180px; top: 9px; font-size: 200%;'>QUESTIONS</div>
            <input class='backBtnCreateQuestionSelect' type='button' onclick='addQuestions()' value='Add Questions' style='left: 1612px; bottom: 32px;'>
            <form id='createExam' name='createExam' method='post' action='frontCreateExam.php'>
            <input type='checkbox' name='submit2' value='true' hidden checked>
            <input type='checkbox' name='examName' value='$examName' hidden checked>
            <input type='checkbox' name='qNumber' value='$qNumber' hidden checked>
            <div class='dropbox2' id='dropbox2' name='dropbox2' ondragover='allowDrop(event)' ondrop='dropRemove(event)'></div>
            <div class='qFrame' id='qFrame'>";
            $dBottom = 62;
            $nBottom = -5;
            $sBottom = 125;
            for($i = 0; $i < $qNumber; $i++){
              echo "<p class='qNumbers' style='bottom: " . $nBottom . "px;'>" . ($i+1) . ". </p>
                    <div id='root$i' hidden></div>
                    <div class='dropbox' id='dropbox' name='dropbox' ondragover='allowDrop(event)' ondrop='dropAdd(event, \"$i\")' style='bottom: " . $dBottom . "px;'></div><br/>";
                    $dBottom = ($dBottom + 69);
                    $nBottom = ($nBottom + 69);
              echo "<input class='scoreBox' type='number' name='score$i' style='bottom: " . $sBottom . "px;' min=0 max=100 value=0 style='width: 60px;'>";
                    $sBottom = ($sBottom + 69);
            }
    echo "</div>
          <input class='mcBtn' id='mcBtn' type='button' value='MULTIPLE CHOICE' onclick='getQuestions(\"mc\")'>"; //add question functionality hinges on location of this div
    echo "<input class='fitbBtn' type='button' value='FILL IN THE BLANK' onclick='getQuestions(\"fitb\")'>
          <input class='tfBtn' type='button' value='TRUE OR FALSE' onclick='getQuestions(\"tf\")'>
          <input class='oeBtn' type='button' value='OPEN-ENDED' onclick='getQuestions(\"oe\")'>
          <input class='searchBtn' type='button' value='SEARCH' onclick='getSearchQuestions()'>";
    echo "<input class='createQuestionSubmit' type='submit' name='submit' id='submit' value='Submit' style='left: 93px; top: -760px;'>";
    echo "</form>";
    echo "<form name='backToLogin' action='frontWelcomeTeacher.php'>
            <input type='submit' class='backBtnCreateExam' name='submit' id='submit' value='Back to Menu' style='bottom: 800px; left: 1620px;'>
          </form>
          </div>
          </body>";
  }
            
    if(isset($_POST['submit2'])){
      //print_r($_POST);
      $qNumber = $_POST['qNumber'];
      $examName = $_POST['examName'];
      $keyList = array();
      $valueList = array();
      foreach($_POST as $key=>$value){
        array_push($keyList, $key);
        array_push($valueList, $value);
      } 
      
      //removes first three elems and last elem for each list (examName, qNumbers, submit)
      array_shift($keyList);
      array_shift($keyList);
      array_shift($keyList);
      array_shift($valueList);
      array_shift($valueList);
      array_shift($valueList);
      
      //removes score values from array
      $size = sizeof($keyList);
      for($i = 0; $i < $size; $i++){
        if(strpos($keyList[$i], "core") != false){
          unset($keyList[$i]);
          unset($valueList[$i]);
        }
      }
      
      //re-indexes array after unset
      $keyList = array_values($keyList);
      $valueList = array_values($valueList);
      
      //adds question data to post
      $post = null;
      for($i = 0; $i < $size; $i++){
        if(strpos($keyList[$i], "mc") != false)
            $post = $post . "&" . $i . "mc=" . $valueList[$i];
        else if(strpos($keyList[$i], "fitb") != false)
            $post = $post . "&" . $i . "fitb=" . $valueList[$i];
        else if(strpos($keyList[$i], "tf") != false)
            $post = $post . "&" . $i . "tf=" . $valueList[$i];
        else if(strpos($keyList[$i], "oe") != false)
            $post = $post . "&" . $i . "oe=" . $valueList[$i];
      }
      
      $post = "examName=" . $examName . "&qNumber=" . $qNumber . $post;
      
      
    
      //adds score values to post
      //$size = sizeof($keyList)-1;
      $size = sizeof($keyList)-1;
      for($i = 0; $i < $size; $i++){
        $element = $keyList[$i];
        $firstChar = $element[0];
        $post = $post . "&score" . $i . "=" . $_POST['score' . $firstChar];
      }
      
      //$url = "https://web.njit.edu/~edm8/cs490/Middle/middleCreateExamProcess.php";
      $url = "https://web.njit.edu/~tkt6/cs490/Middle/middleCreateExamProcess.php";
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_POST, TRUE);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
      $response = curl_exec($ch);
      curl_close($ch);
      echo $response;
      
    echo "<script type='text/javascript'>
             window.location.href='https://web.njit.edu/~edm8/cs490/Front/frontWelcomeTeacher.php';
          </script>";
    }
?>

<?php
    //session_destroy();
?>
