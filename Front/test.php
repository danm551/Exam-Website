<?php
    $qType = "fitb";
    echo "<head>
    <style>
      #dropbox{
        width: 700px;
        height: 700px;
        padding: 10px;
        border: 1px solid #aaaaaa;
        position: relative;
        left: 800px;
      }
      #dropbox2{
        width: 700px;
        height: 700px;
        padding: 10px;
        border: 1px solid #aaaaaa;
        position: relative;
        bottom: 720px;
      }
    </style>
    <script>
      function allowDrop(ev){
        ev.preventDefault();
      }
      function drag(ev){
        ev.dataTransfer.setData('text', ev.target.id);
      }
      function dropAdd(ev){
        ev.preventDefault;
        var data = ev.dataTransfer.getData('text');
        ev.target.appendChild(document.getElementById(data));
        
        var list = 'list';
        var doesItExist = document.getElementById(list.concat(data));
        
        if(doesItExist == null){
          var val = document.getElementById(data).childNodes[0].textContent;
          var node = document.createElement('INPUT');
          node.setAttribute('type', 'checkbox');
          node.setAttribute('id', list.concat(data));
          node.setAttribute('name', list.concat(data));
          node.setAttribute('hidden', true);
          node.setAttribute('checked', true);
          node.setAttribute('value', val);
          
          var form = document.getElementById('createExam');
          form.insertBefore(node, document.getElementById('submit'));
        }
      }
      function dropRemove(ev){
        ev.preventDefault;
        var data = ev.dataTransfer.getData('text');
        ev.target.appendChild(document.getElementById(data));
        
        var list = 'list';
        var parent = document.getElementById('createExam');
        var child = document.getElementById(list.concat(data));
        parent.removeChild(child);
        
      }
      function getQuestions(type){
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange =
        function(){
          if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
              var jsonObj = JSON.parse(xmlhttp.responseText);
              
              var indexString = Object.keys(jsonObj);
              var indexArray = JSON.parse('[' + indexString + ']');

              for(i = 0; i < indexArray.length; i++){
                var index = indexArray[i];

                var node = document.createElement('DIV');
                node.setAttribute('id', type.concat('question', index));
                node.setAttribute('ondragstart', 'drag(event)');
                node.setAttribute('ondragstart', 'drag(event)');
                node.setAttribute('draggable', 'true');
                
                node.innerHTML = index + ')  ' + jsonObj[index];
            
                var parent = document.getElementById('dropbox2');
                parent.appendChild(node);
              }
          }
          else{
              document.getElementById('dropbox2').innerHTML = 'Waiting for server response!';
          }
        }
        
        xmlhttp.open('POST', 'https://web.njit.edu/~edm8/cs490/Middle/middleGetQuestions.php', true);
        xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        var qType = 'qType=';
        qType = qType.concat(type);
        alert(qType);
        xmlhttp.send(qType);
      }
    </script> 
  <head>
  <body>
    <form id='createExam' name='test' method='post' action='test.php'>
      <div class='dropbox' id='dropbox' name='div' ondragover='allowDrop(event)' ondrop='dropAdd(event)'></div>
      <div class='dropbox2' id='dropbox2' ondragover='allowDrop(event)' ondrop='dropRemove(event)'>
      </div>
      <input type='button' value='Get Questions' onclick='getQuestions(\"$qType\")'>
      <input id='submit' type='submit' name='submit'>
    </form>
  <body>
  <html>";
?>
