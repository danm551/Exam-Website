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
        
        //builds and adds hidden input elements (to add into $_POST) if the element doesn't exist
        if(doesItExist == null){ 
          ev.preventDefault;
          ev.target.appendChild(document.getElementById(data));
          var num = data.match(/\d+/g);
        
          var val = document.getElementById(data).childNodes[0].textContent;
          var node = document.createElement('INPUT');
          node.setAttribute('id', list.concat(data));
          node.setAttribute('name', id.concat(data));
          node.setAttribute('type', 'checkbox');
          node.setAttribute('value', num)
          node.setAttribute('hidden', true);
          node.setAttribute('checked', true);
          node.setAttribute('order', id);
          var parent = document.getElementById('qFrame');
          
          var targetNode = "root" + id;
          parent.insertBefore(node, document.getElementById(targetNode));
        }
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
      function confirmation(){
        var value = confirm('Are you sure you want to delete these questions?');
        if(!value)
          return false;
      }
  </script>
</html>
<?php
    $qNumber = 50;
    echo "   <header>
	           <p class='poiretOne' style='font-size: 200%;'>DELETE QUESTIONS</p>
             </header>
            <form id='createExam' name='createExam' method='post' action='frontRemoveQuestion.php' onsubmit='return confirmation()'>
            <div class='resultsText' style='left: 1280px; top: 50px; font-size: 200%;'>DELETE</div>
            <input type='checkbox' name='submit2' value='true' hidden checked>
            <input type='checkbox' name='examName' value='$examName' hidden checked>
            <input type='checkbox' name='qNumber' value='$qNumber' hidden checked>
            <div class='dropbox2' id='dropbox2' name='dropbox2' ondragover='allowDrop(event)' ondrop='dropRemove(event)' style='bottom: -50px;'></div>
            <div class='qFrame' id='qFrame' style='bottom: 696px;'>";
            $dBottom = 62;
            $nBottom = -5;
            $sBottom = 125;
            for($i = 0; $i < $qNumber; $i++){
              echo "<p class='qNumbers' style='bottom: " . $nBottom . "px;'>" . ($i+1) . ". </p>
                    <div id='root$i' hidden></div>
                    <div class='dropbox' id='dropbox' name='dropbox' ondragover='allowDrop(event)' ondrop='dropAdd(event, \"$i\")' style='bottom: " . $dBottom . "px;'></div><br/>";
                    $dBottom = ($dBottom + 69);
                    $nBottom = ($nBottom + 69);
              echo "<input class='scoreBox' type='number' name='score$i' style='bottom: " . $sBottom . "px;' min=0 max=100 value=0>";
                    $sBottom = ($sBottom + 69);
            }
    echo "</div>
          <input class='mcBtn' id='mcBtn' type='button' value='MULTIPLE CHOICE' onclick='getQuestions(\"mc\")' style='bottom: 1482px;'>"; //add question functionality hinges on location of this div
    echo "<input class='fitbBtn' type='button' value='FILL IN THE BLANK' onclick='getQuestions(\"fitb\")' style='bottom: 1482px;'>
            <input class='tfBtn' type='button' value='TRUE OR FALSE' onclick='getQuestions(\"tf\")' style='bottom: 1482px;'>
            <input class='oeBtn' type='button' value='OPEN-ENDED' onclick='getQuestions(\"oe\")' style='bottom: 1482px;'>";
    echo "<input class='createQuestionSubmit' type='submit' name='submit' id='submit' value='Submit' style='left: 77px; top: -1484px;'>";
    echo "</form>";
    echo "<form name='backToLogin' action='frontWelcomeTeacher.php'>
            <input class='backBtnCreateExam' type='submit' name='submit' id='submit' value='Back to Menu' style='bottom: 1523px; left: 1620px;'>
          </form>";
          
      //echo print_r($_POST);
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
      
      //echo print_r($keyList);
      //echo print_r($valueList);
      
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
      
      //echo $post;
      
      //$url = "https://web.njit.edu/~edm8/cs490/Middle/middleRemoveQuestion.php";
      $url = "https://web.njit.edu/~tkt6/cs490/Middle/middleRemoveQuestion.php";
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_POST, TRUE);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
      $response = curl_exec($ch);
      curl_close($ch);
      echo $response;
?>

<?php
    //session_destroy();
?>