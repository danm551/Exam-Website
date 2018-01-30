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
        
          var val = document.getElementById(data).childNodes[0].textContent;
          var node = document.createElement('INPUT');
          node.setAttribute('id', list.concat(data));
          node.setAttribute('name', id.concat(data));
          node.setAttribute('type', 'checkbox');
          node.setAttribute('value', val)
          node.setAttribute('hidden', true);
          node.setAttribute('checked', true);
          var form = document.getElementById('createExam');
          form.insertBefore(node, document.getElementById('submit'));
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
                node.setAttribute('id', type.concat('question', index));
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
        xmlhttp.open('POST', 'https://web.njit.edu/~edm8/cs490/Middle/middleGetQuestions.php', true);
        xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xmlhttp.send(qType);
      }
    </script>