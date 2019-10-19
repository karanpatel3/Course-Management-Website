<head>
</head>
<body onload="loadQuestions()">
<?php include 'instnavbar.php';?>
<link rel="stylesheet" type="text/css" href="ExamQuestion2.css" />
<div class="container">
    <div class="flex-item">
        <table id="myTable">
            <form id="myform">
                <tr class="header">
                    <th style="width:20%;">Question</th>
                    <th style="width:20%;">Difficulty</th>
                    <th style="width:20%;">Topic</th>
                    <th style="width:20%;">Points</th>
                    <th style="width:20%;">Select Question</th>
                </tr>
        </table>
        <table id="myTable">
        </table>
        <button type="submit">Submit</button>
        </form>
    </div>
</div>

<div id="response"></div>
<script>
    function loadQuestions(){
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'http://afsaccess1.njit.edu/~kp486/TestView.php', true);

        xhr.onload = function(){
            if(this.status == 200){
                var questions = JSON.parse(this.responseText);

                var arrayLength = questions.length;

                var t='';
                for (var i = 0; i < arrayLength; i++) {
                    var tr = "<tr>";
                    tr += "<td>" +questions[i].Question+"</td>";
                    tr += "<td>" +questions[i].Difficulty+"</td>";
                    tr += "<td>" +questions[i].Topic+"</td>";
                    tr += "<td><input type = 'textarea' class='points' name='points[]' id='points'></textarea>";
                    tr += "<td><input type = 'checkbox' name='check[]' class='checkbox' id='Checkbox'></checkbox>";
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
</script>
<!--<script>
    function() {
        var $rows = $('#myTable tr');
        $('#search').keyup(function() {
            var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase().split(' ');
            $rows.hide().filter(function() {
                var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
                var matchesSearch = true;
                $(val).each(function(index, value) {
                    matchesSearch = (!matchesSearch) ? false : ~text.indexOf(value);
                });
                return matchesSearch;
            }).show();
        });
        $('body').on('click','#hide',function() {
            $('#myTable').find('input:checkbox:not(:checked)').closest('tr').hide();
        });
        $('body').on('click','#unhide',function() {
            $('#myTable').find('input:checkbox:not(:checked)').closest('tr').show();
        });
    });
</script> -->
</body>
