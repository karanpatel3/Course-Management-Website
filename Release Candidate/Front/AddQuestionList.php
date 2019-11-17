<body>
<style>
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
}
button .out {
    width: 60px;
}
</style>
<form action="questioncurl.php" method="POST">
    <div class="container">
            <h3 align="center" >Add Questions</h3>

            <textarea class="form-control flat" id="problem" rows="3" placeholder="Enter Question"></textarea>

            <!-- <br><textarea class="form-control flat" id="topic" rows="3" placeholder="Topic"></textarea> -->
            <h4>Topic</h4>

            <select id="topiclist" name="topic">

            <option value="String">String<br></option>
            <option value="Conditional">Conditional<br></option>
            <option value="Arithmetic">Arithmetic<br></option>

            </select>
            <br>
          </br>

            <textarea class="form-control flat" id="functionname" rows="3" placeholder="Function Name"></textarea>

            <br><textarea class="form-control flat" id="testcase1" rows="3" placeholder="Test Case 1"></textarea>
            <textarea class="form-control flat" id="testcase1op" rows="3" placeholder="Test Case 1 Output"></textarea>

			      <br><textarea class="form-control flat" id="testcase2" rows="3" placeholder="Test Case 2"></textarea>
            <textarea class="form-control flat" id="testcase2op" rows="3" placeholder="Test Case 2 Output "></textarea>

			      <br><textarea class="form-control flat" id="testcase3" rows="3" placeholder="Test Case 3"></textarea>
            <textarea class="form-control flat" id="testcase3op" rows="3" placeholder="Test Case 3 Output"></textarea>

            <br><textarea class="form-control flat" id="testcase4" rows="3" placeholder="Test Case 4"></textarea>
            <textarea class="form-control flat" id="testcase4op" rows="3" placeholder="Test Case 4 Output"></textarea>

            <br><textarea class="form-control flat" id="testcase5" rows="3" placeholder="Test Case 5"></textarea>
            <textarea class="form-control flat" id="testcase5op" rows="3" placeholder="Test Case 5 Output"></textarea>

            <br><textarea class="form-control flat" id="testcase6" rows="3" placeholder="Test Case 6"></textarea>
            <textarea class="form-control flat" id="testcase6op" rows="3" placeholder="Test Case 6 Output"></textarea>


         <!-- <textarea class="form-control flat" id="points" rows="3" placeholder="Assign points.."></textarea> -->

          <!-- /container  -->
           <h4>Constraints</h4>

           <!-- <input type="radio" id="question_type" name="question_type" value="for"> For<br>
           <input type="radio" id="question_type1" name="question_type" value="while"> While<br>
           <input type="radio" id="question_type2" name="question_type" value="print"> Print<br> -->

           <select id="questiontype" name="questiontype">

            <option value="None">None<br></option>
            <option value="For">For<br></option>
            <option value="While">While<br></option>
            <option value="Print">Print<br></option>

          </select>

         <!-- /container -->
           <h4>Difficulty<h4>

            <!-- <input type="radio" id="difficulty" name="difficulty" value="easy"> Easy<br>
            <input type="radio" id="difficulty1" name="difficulty" value="medium"> Medium<br>
            <input type="radio" id="difficulty2" name="difficulty" value="hard"> Hard -->

            <select id="difficultylist" name="difficultylist">

            <option value="Easy">Easy<br></option>
            <option value="Medium">medium<br></option>
            <option value="Hard">hard<br></option>

            </select>
          <!-- </p> -->
          <br><br><button type="button" onclick="send()">Add question</button>
          <div id="test">Work</div>

</div> <!-- /container -->
 <div id="test"></div>
 </form>
<script>
function send()
{
var xhttp;
if (window.XMLHttpRequest)
  {
  // for newer browers
  xhttp=new XMLHttpRequest();
  }
else
  {
  // code for njit machines
  xhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xhttp.onreadystatechange=function()
//readyState: 4: request finished and response is ready, status: 200: "OK"  and When readyState is 4 and status is 200, the response is ready:
  {
  if (this.readyState==4 && this.status==200)
    {
    document.getElementById("test").innerHTML=this.responseText;
    }
  }
xhttp.open("POST","http://afsaccess1.njit.edu/~ntb6/questioncurl.php",true); //ANYTHING HERE WILL BE ECHO'd
xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
// if( document.getElementById('difficulty').checked){
    // else if( document.getElementById('difficulty1').checked){
    // var difficulty = document.getElementById("difficulty1").value;}
    // else if( document.getElementById('difficulty2').checked){
    // var difficulty = document.getElementById("difficulty2").value;
    // }
    // else{
    // var difficulty = null;
    // }

// if( document.getElementById('question_type').checked){
    // else if( document.getElementById('question_type1').checked){
    // var question_type = document.getElementById("question_type1").value;}
    // else if( document.getElementById('question_type2').checked){
    // var question_type= document.getElementById("question_type2").value;
    // }
    // else{
    // var question_type = null;
    // }

var constraint = document.getElementById("questiontype").value;
var difficulty = document.getElementById("difficultylist").value;
var problem = document.getElementById('problem').value;
var topic = document.getElementById('topiclist').value;
var functionname = document.getElementById('functionname').value;
// var points = document.getElementById('points').value;
var testcase1 = document.getElementById('testcase1').value;
var testcase1op = document.getElementById('testcase1op').value
var testcase2 = document.getElementById('testcase2').value;
var testcase2op = document.getElementById('testcase2op').value;
var testcase3 = document.getElementById('testcase3').value;
var testcase3op = document.getElementById('testcase3op').value;
var testcase4 = document.getElementById('testcase4').value;
var testcase4op = document.getElementById('testcase4op').value;
var testcase5 = document.getElementById('testcase5').value;
var testcase5op = document.getElementById('testcase5op').value;
var testcase6 = document.getElementById('testcase6').value;
var testcase6op = document.getElementById('testcase6op').value;


// var testcase1 = document.querySelectorAll("id='testcase1'").value;
// var testcase1 = document.querySelectorAll('testcase1'").value;


xhttp.send("topic=" +encodeURIComponent(topic)
	+ "&difficulty=" +encodeURIComponent(difficulty)
  + "&constraint=" +encodeURIComponent(constraint)
	+ "&problem=" +encodeURIComponent(problem)
  + "&functionname=" +encodeURIComponent(functionname)
	+ "&testcase1=" +encodeURIComponent(testcase1)
  + "&testcase1op=" +encodeURIComponent(testcase1op)
	+ "&testcase2=" +encodeURIComponent(testcase2)
  + "&testcase2op=" +encodeURIComponent(testcase2op)
	+ "&testcase3=" +encodeURIComponent(testcase3)
  + "&testcase3op=" +encodeURIComponent(testcase3op)
	+ "&testcase4=" +encodeURIComponent(testcase4)
  + "&testcase4op=" +encodeURIComponent(testcase4op)
	+ "&testcase5=" +encodeURIComponent(testcase5)
  + "&testcase5op=" +encodeURIComponent(testcase5op)
  + "&testcase6=" +encodeURIComponent(testcase6)
  + "&testcase6op=" +encodeURIComponent(testcase6op));


	// + "&points=" +encodeURIComponent(points));
//sends post after clicking the button
}
</script>
