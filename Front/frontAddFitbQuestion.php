<?php
    /*session_start();
    if(isset($_SESSION['Username'])){
    }
    else{
        header("Location:http://localhost/cs431/Front/login.html");
        exit;
    }*/
?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="style.css">
<link href='https://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Crete+Round' rel='stylesheet' type='text/css'>
    <header>
    </header>
    <body>
      <div class='createQuestionBox' style='background: rgb(195, 239, 192); width: 1550px; height: 800px;'>
        <form name="addQuestion" method="post" action="frontAddQuestionProcess.php">
            <p class='addQuestion' style'font-size: 150%;'>CREATE QUESTION: FILL IN THE BLANK</p><br>
                    <input type="radio" name="qType" value="fitb" checked hidden>
                    <p class='resultsText'>
                      Write your question: <input class="textbox" type="text" name="fitb-question" id="fitb-question" style='left: 85px;width: 500px;' required><br><br>
                      Answer:<input class="textbox" type="text" name="fitb-a1" id="fitb-a1" style='left: 176px;width: 200px;' required><br><br>
                      Wrong Answer Comment:<input class="textbox" type="text" name="fitb-comm" size=200 style='left: 50px;width: 500px;' required><br><br>
                      <input class='createQuestionSubmit' type="submit" name="submit" id="submit" value="Submit Question">
                    </p>
        </form>
        </form>
         <form name="backToLogin" action="frontWelcomeTeacher.php">
            <input class="backBtnCreateQuestionSelect" type="submit" name="submit" id="submit" value="Back to Menu" style='left: 250px; bottom: 39px;'>
        </form>
        <form name="backToLogin" action="frontAddMcQuestion.php">
            <input class="backBtnCreateQuestionSelect" type="submit" name="submit" id="submit" value="MULTIPLE CHOICE" style='left: 500px; bottom: 77px; background: #3498db;'>
        </form>
        <form name="backToLogin" action="frontAddTfQuestion.php">
            <input class="backBtnCreateQuestionSelect" type="submit" name="submit" id="submit" value="TRUE OR FALSE" style='left: 500px; bottom: 70px; background: #a8911c;'>
        </form>
        <form name="backToLogin" action="frontAddOeQuestion.php">
            <input class="backBtnCreateQuestionSelect" type="submit" name="submit" id="submit" value="OPEN-ENDED" style='left: 500px; bottom: 63px; background: #9c0909;'>
        </form>
        <div class='addQuestonFrame' id='qFrame' style='bottom: 451px; '>
          <script>
              type = "fitb";
              var qType = 'qType=' + type;
              //deletes existing list
              var deleteChildren = document.getElementById("qFrame");
              
              while(deleteChildren.firstChild){
                deleteChildren.removeChild(deleteChildren.firstChild);
              }
        
              //begins ajax procedure
              xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange =
              function(){
                if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                    var jsonObj = JSON.parse(xmlhttp.responseText); //parses the response into a JSON object
                    //var test = JSON.stringify(jsonObj);
                    //alert(test);
                    
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
                  
                      var parent = document.getElementById('qFrame');
                      parent.appendChild(node);
                    }
                }
                else{
                    //document.getElementById('dropbox2').innerHTML = 'Waiting for server response!';
                }
              }
              
              //ajax syntax to send the POST
              xmlhttp.open('POST', 'https://web.njit.edu/~edm8/cs490/Middle/middleGetQuestions.php', true);
              xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
              xmlhttp.send(qType);
          </script>
        </div>
      </div>
    </body>
</html>

<?php
    //session_destroy();
?>