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
      <div class='createQuestionBox' style='background: rgb(206, 152, 152); width: 1550px; height: 1000px;'>
        <form name="addQuestion" method="post" action="frontAddQuestionProcess.php">
            <p class='addQuestion' style'font-size: 150%;'>CREATE QUESTION: OPEN-ENDED</p><br>
                    <input type="radio" name="qType" value="oe" checked hidden>
                    <p class='resultsText'>
                        STEP 1:&nbsp;&nbsp;Write a function named: <input class="textbox" type="text" name="oe-funcName" style='left: 20px;' required><br><br>
                    </p>
                    <p class='resultsText'>
                        STEP 2:&nbsp;&nbsp;That takes: 
                        <div class='styledSelect' style='left: 160px; bottom: 41px; width: 100px;'>
                          <select name="args" required>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                          </select>
                        </div> 
                        <p class='resultsText' style='position: relative; bottom: 84px; left: 280px;'>argument(s).</p>
                    </p>
                    <p class='resultsText' style='position: relative; bottom: 50px;'>
                        STEP 3:&nbsp;&nbsp;And (e.g. "adds them"):<input class="textbox" type="text" name="oe-question" style='left: 20px; width: 400px;' required><br>
                    </p>
                    <p class='resultsText'>
                        STEP 4:&nbsp;&nbsp;The function will return a(n):  
                        <div class='styledSelect' style='left: 290px; bottom: 41px; width: 100px;'>
                          <select name="oe-returns" required>
                            <option value="int">Int</option>
                            <option value="double">Double</option>
                            <option value="String">String</option>
                          </select>
                        </div>
                    </p>
                    <p class='resultsText'>
                        STEP 5:&nbsp;&nbsp;Name the arguments that will be passed to the student&#39;s function (e.g. "num1=5"): <br>
                                              <input class="textbox" type="text" name="oe-arg1" style='left: 50px; top: 20px;'> <p class='resultsText' style='position: relative; left: 360px; bottom: 27px;'>
                                              (Do not add semicolon) of type</p>
                                              <div class='styledSelect' style='left: 600px; bottom: 68px; width: 100px;'>
                                                  <select name="oe-type1">
                                                    <option value=""></option>
                                                    <option value="int">Int</option>
                                                    <option value="double">Double</option>
                                                    <option value="float">Float</option>
                                                    <option value="String">String</option>
                                                  </select> (Do not add semicolon)<br>
                                              </div>
                                              <input class="textbox" type="text" name="oe-arg2" style='left: 50px; bottom: 40px;'> <p class='resultsText' style='position: relative; left: 360px; bottom: 87px;'>
                                              (Do not add semicolon) of type</p>
                                              <div class='styledSelect' style='left: 600px; bottom: 128px; width: 100px;'>
                                                  <select name="oe-type2">
                                                    <option value=""></option>
                                                    <option value="int">Int</option>
                                                    <option value="double">Double</option>
                                                    <option value="float">Float</option>
                                                    <option value="String">String</option>
                                                  </select> (Do not add semicolon)<br>
                                              </div>
                                              <input class="textbox" type="text" name="oe-arg3" style='left: 50px; bottom: 100px;'> <p class='resultsText' style='position: relative; left: 360px; bottom: 147px;'>
                                              (Do not add semicolon) of type</p>
                                              <div class='styledSelect' style='left: 600px; bottom: 188px; width: 100px;'>
                                                  <select name="oe-type3">
                                                    <option value=""></option>
                                                    <option value="int">Int</option>
                                                    <option value="double">Double</option>
                                                    <option value="float">Float</option>
                                                    <option value="String">String</option>
                                                  </select> (Do not add semicolon)<br>
                                              </div>
                                              <input class="textbox" type="text" name="oe-arg4" style='left: 50px; bottom: 160px;'> <p class='resultsText' style='position: relative; left: 360px; bottom: 207px;'>
                                              (Do not add semicolon) of type</p>
                                              <div class='styledSelect' style='left: 600px; bottom: 248px; width: 100px;'>
                                                  <select name="oe-type4">
                                                    <option value=""></option>
                                                    <option value="int">Int</option>
                                                    <option value="double">Double</option>
                                                    <option value="float">Float</option>
                                                    <option value="String">String</option>
                                                  </select><br>
                                              </div>
                        </p>
                        <p class='resultsText' style='bottom: 200px;'>
                          STEP 6:&nbsp;&nbsp;Answer:<input class="textbox" type="text" name="oe-a1" id="oe-a1" style='left: 20px;' required>
                          <input class='createQuestionSubmit' type="submit" name="submit" id="submit" value="Submit Question" style='top: 100px; right: 406px;'>
                        </p>
        </form>
         <form name="backToLogin" action="frontWelcomeTeacher.php">
            <input class="backBtnCreateQuestionSelect" type="submit" name="submit" id="submit" value="Back to Menu" style='left: 260px; bottom: 154px;'>
        </form>
        <form name="backToLogin" action="frontAddMcQuestion.php">
            <input class="backBtnCreateQuestionSelect" type="submit" name="submit" id="submit" value="MULTIPLE CHOICE" style='left: 700px; bottom: 192px; background: #3498db;'>
        </form>
        <form name="backToLogin" action="frontAddFitbQuestion.php">
            <input class="backBtnCreateQuestionSelect" type="submit" name="submit" id="submit" value="FILL IN THE BLANK" style='left: 700px; bottom: 185px; background: #2c8247;'>
        </form>
        <form name="backToLogin" action="frontAddTfQuestion.php">
            <input class="backBtnCreateQuestionSelect" type="submit" name="submit" id="submit" value="TRUE OR FALSE" style='left: 700px; bottom: 178px; background: #a8911c;'>
        </form>
        <div class='addQuestonFrame' id='qFrame' style='bottom: 1112px; '>
          <script>
              type = "oe";
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