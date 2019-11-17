
<head>
</head>
<body onload="loadQuestions()">
<link rel="stylesheet" type="text/css" href="ExamQuestion2.css" />
<div class="container">
    <div class="flex-item">
        <table id="myTable">
            <form id="myform">
                <tr class="header">
                    <th style="width:20%;">QID</th>
                    <th style="width:20%;">Question</th>
                    <th style="width:20%;">Difficulty</th>
                    <th style="width:20%;">Topic</th>
                    <th style="width:20%;">Function Name</th>
                    <th style="width:20%;">Points</th>
                    <th style="width:20%;">Select Question</th>
                </tr>
        </table>
        <table id="myTable">
        </table>
        <button type="submit" id="submit" onclick="return confirm('Do you want to submit this exam?')">Submit</button>
        </form>
    </div>
</div>

<div id="response"></div>
<script>

    var i=0;
    document.getElementById('submit').addEventListener('click', makeExam);


    function loadQuestions(){

        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'http://afsaccess1.njit.edu/~kp486/TestView.php', true);

        xhr.onload = function(){
            if(this.status == 200){
                var questions = JSON.parse(this.responseText);

                var arrayLength = questions.length;

                var t='';
                for (i = 0; i < arrayLength; i++) {
                    var tr = "<tr>";
                    tr += "<td id='QID'>" +questions[i].QID+"</td>";
                    tr += "<td id='Question'>" +questions[i].Question+"</td>";
                    tr += "<td id='Difficulty'>" +questions[i].Difficulty+"</td>";
                    tr += "<td id='Topic'>" +questions[i].Topic+"</td>";
                    tr += "<td id='FunctionName'>" +questions[i].FunctionName+"</td>";
                    tr += "<td id='Points'><input type = 'textarea' class='points' name='points[]' id='points'></textarea>";
                    tr += "<td><input type = 'checkbox' name='check[]' value='checkbox' id='Checkbox'></checkbox>";
                    t += tr;

                }
                document.getElementById("myTable").innerHTML+= t;
            }
            if(this.status == 404){
                console.log("404 error");
            }
        }

        xhr.send();
    }

    function makeExam(){
        var table = document.getElementById('myTable');
        var rowCells;
        var checkbox;
        var input;
        var test = [];

        console.log('button pressed');

        var rowCount = document.getElementById('myTable').rows.length;
        for (var z = 1; z < rowCount; z++) {
            rowCells = table.rows[z].cells;
            checkbox = table.rows[z].querySelectorAll('input[type="checkbox"]');
            input = table.rows[z].querySelectorAll('input[type="textarea"');

            if (checkbox[0].checked == true) {

                test.push({
                    QID: rowCells[0].innerHTML,
                    // functionname: rowCells[4].innerHTML,
                    Points: input[0].value
                });
            }
        }

        $payload = JSON.stringify(test);

        console.log($payload);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'http://afsaccess1.njit.edu/~kp486/TestAdd.php', true);
        xhr.setRequestHeader('Content-Type','application/json');
        xhr.send($payload);
        // xhr.open('POST', 'http://afsaccess1.njit.edu/~ntb6/invalid.html', true);
        // xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        // xhr.open("POST","http://afsaccess1.njit.edu/~ntb6/invalid.html",true);
        // window.location.href = "http://afsaccess1.njit.edu/~ntb6/invalid.html";

          // {
          // }
    }
</script>
</body>
