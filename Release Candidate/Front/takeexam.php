<head>
</head>
<body onload="loadQuestions()">
<?php include 'studnavbaralt.php';?>
<link rel="stylesheet" type="text/css" href="ExamQuestion2.css" />
<div class="container">
    <div class="flex-item">
        <table id="myTable">
            <form id="myform">
                <tr class="header">
                    <!-- <th style="width:20%;">QID</th> -->
                    <th style="width:20%;">Question</th>
                    <th style="width:20%;">Points</th>
                    <th style="width:20%;">Answer</th>

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
    document.getElementById('submit').addEventListener('click', makeExam);
    var i;

    function loadQuestions(){
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'http://afsaccess1.njit.edu/~kp486/TakeExam.php', true);

        xhr.onload = function(){
            if(this.status == 200){
                var questions = JSON.parse(this.responseText);

                var arrayLength = questions.length;

                var t='';
                for (i = 0; i < arrayLength; i++) {
                    var tr = "<tr>";
                    // tr += "<td id='QID'>" +questions[i].QID+"</td>";
                    // tr += "<td id='Question'>" +questions[i].Question+"</td>";
                    // tr += "<td id='Answer'><input type = 'textarea' class='answer' name='answer[]' id='answer'></textarea>";
                    // // tr += "<td id='Answer'><input type = ''        >";
                    // tr += "<td id='Points'>" +questions[i].Points+"</td>";
                    // t += tr;
                    // <!-- <br><textarea class="form-control flat" id="testcase2" rows="3" placeholder="Test Case 2"></textarea> -->
                    // tr += "<td id='QID'>" +questions[i].QID+"</td>";
                    tr += "<td id='Question'>" +questions[i].Question+"</td>";
                    // tr += "<td id='Difficulty'>" +questions[i].Difficulty+"</td>";
                    // tr += "<td id='Topic'>" +questions[i].Topic+"</td>";
                    tr += "<td id='Points'>" +questions[i].Points+"</td>";
                    tr += "<td id='Answer'><input type = 'textarea' class='answer' name='answer[]' id='answer'></textarea>";

                    // tr += "<td><input type = 'checkbox' name='check[]' value='checkbox' id='Checkbox'></checkbox>";
                    t += tr;
                }
                document.getElementById("myTable").innerHTML+= t;
            }
            if(this.status == 404){
                console.log("404 error");
            }
            if(this.status == null){
                console.log("THERE ARE NO TESTS AVAILABLE");
              }
        }

        xhr.send();
    }

    function makeExam(){
        var table = document.getElementById('myTable');
        var rowCells;
        var input;
        var test = [];

        console.log('button pressed');

        var rowCount = document.getElementById('myTable').rows.length;
        for (var z = 1; z < rowCount; z++) {
            rowCells = table.rows[z].cells;
            input = table.rows[z].querySelectorAll('input[type="textarea"');

            test.push({
                Question: rowCells[0].innerHTML,
                Points: rowCells[1].innerHTML,
                Answer: input[0].value
            });
        }

        $payload = JSON.stringify(test);

        console.log($payload);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'http://afsaccess1.njit.edu/~kp486/StoreAnswers.php', true);
        xhr.setRequestHeader('Content-Type','application/json');
        xhr.send($payload);

    }
</script>
</body>
