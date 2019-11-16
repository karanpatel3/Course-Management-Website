<?php
$answer = "def operation(op, a, b)
	if op == '+':
		return a+b
	elif op == '-':
		return a-b
	elif op == '*':
		return a*b
	elif op == '/':
		return a/b
	else:
		return \"error\"";
$points = 20;
$functionName = "xd";
$constraint = "for";
$testcases = array("\"-\",5,3.1", "\"+\",5,3.7", "\"*\",5,3.14", "\"/\",4,2.1", "\"/\",4,2.1", "\"/\",4,2.1");

function checkColon($ans){
    $answer = $ans;
    $line = strstr($answer,"\n",true);
    if (strstr($line, ':')) {
        return true;
    } else {
        return false;
    }
}
function checkFuncName($funcName, $ans){
    $functionName = $funcName;
    $funcFile = fopen("/afs/cad.njit.edu/u/a/j/ajr74/public_html/funcName.txt", "w") or die("Unable to open file.");
    $answer = $ans;
    fwrite($funcFile, $functionName);

    if(!checkColon($answer)){
        $answerFile = fopen("/afs/cad.njit.edu/u/a/j/ajr74/public_html/answer.txt", "w") or die("Unable to open file.");
        $firstline = strstr($answer,"\n",true);
        $firstline = rtrim($firstline);
        $colon =':';
        $newAnswer = str_replace($firstline, $firstline.$colon, $answer);
        fwrite($answerFile, $newAnswer);
    }else{
        $answerFile = fopen("/afs/cad.njit.edu/u/a/j/ajr74/public_html/answer.txt", "w") or die("Unable to open file.");
        fwrite($answerFile, $answer);
    }

    $execResult = shell_exec('python /afs/cad.njit.edu/u/a/j/ajr74/public_html/funCheck.py');

    fclose($answerFile);
    fclose($funcFile);

    $execResult = trim($execResult);
    if($execResult == "Correct function name"){
        return true;
    } else {
        return false;
    }
}
function checkConstraint($cons, $ans){
    $answer = $ans;
    $constraint = $cons;
    if (strstr($answer, $constraint)) {
        return true;
    } else {
        return false;
    }
}

function checkTestcase($test, $ans){

    $testcase = $test;
    $answer = $ans;

    $funcName = shell_exec('python /afs/cad.njit.edu/u/a/j/ajr74/public_html/funcName.py');

    $funcName = trim($funcName);
    $split = explode(".", $testcase);

    $input = explode(",", $split[0]);
    $output = $split[1];

    $paraNum = sizeof($input);
    $runline = "";

    for($x = 0; $x < $paraNum; $x++){
        if($x == 0){
            $runline = $funcName . "(" . $input[$x];
        }else if($x != $paraNum && $x != 0){
            $runline = $runline . ',' . $input[$x];
        }

        if($x == $paraNum-1){
            $runline = $runline . ")";
        }
    }

    $answer = $answer . "\n" . "print(" . $runline . ")";

    $file = fopen("/afs/cad.njit.edu/u/a/j/ajr74/public_html/pythonExec.py", "w") or die("Unable to open file.");

    fwrite($file, $answer);

    $pyOut = shell_exec('python /afs/cad.njit.edu/u/a/j/ajr74/public_html/pythonExec.py');

    $pyOut = trim($pyOut);

    if($pyOut != $output){
        return false;
    }else{
        return true;
    }
}

function outputGen($inPoints, $funcName, $cons, $ans, $test, $ind){
    $points = $inPoints;
    $answer = $ans;
    $testcases = $test;
    $testOut = [];
    $functionName = $funcName;
    $constraint = $cons;
    $wrongCounter = 0;
    $indicator = $ind;

    if(!checkColon($answer)){
        $minus = floor($points*0.10);
        if($minus == 0){
            $minus = 1;
        }
        $colonMsg = "No : in header, minus " . $minus . " points";
        $wrongCounter++;
    }
    if(!checkFuncName($functionName, $answer)){
        $minus = floor($points*0.10);
        if($minus == 0){
            $minus = 1;
        }
        $funcNameMsg = "Incorrect function name, minus " . $minus . " points";
        $wrongCounter++;
    }
    if(!empty($constraint)){
        if(!checkConstraint($constraint, $answer)){
            $minus = floor($points*0.10);
            if($minus == 0){
                $minus = 1;
            }
            $constraintMsg = "No " . $constraint . " statement used in answer, minus " . $minus . " points";
            $wrongCounter++;
        }
    }
    for($x = 0; $x < sizeof($testcases); $x++){
        if(!checkTestcase($testcases[$x], $answer)){
            if(empty($constraint)){
                $minus = floor($points*(0.80/sizeof($testcases)));
                if($minus == 0){
                    $minus = 1;
                }
            }else{
                $minus = floor($points*(0.70/sizeof($testcases)));
                if($minus == 0){
                    $minus = 1;
                }
            }
            array_push($testOut, "Testcase #" . ($x+1) . " failed minus " . $minus . " points");
        }
    }

    if($wrongCounter == 0){
        return "Nothing Wrong";
    }else{
        if($indicator == 1){
            return $colonMsg;
        }elseif ($indicator == 2){
            return $funcNameMsg;
        }elseif ($indicator == 3){
            return $constraintMsg;
        }elseif ($indicator == 4){
            return $testOut;
        }else{
            return "No indicator";
        }
    }
}

function outputForm(){

}

$out = checkFuncName($functionName, $answer);
$out2 = checkTestcase($testcases[0], $answer);
$out3 = checkColon($answer);
$out4 = checkConstraint($answer, $constraint);
print($out2 . " Testcase");
print("<br>");
print($out . " Function Name");
print("<br>");
print($out3 . " Colon");
print("<br>");
print($out4 . " Constraint");
print("<br>");
print(outputGen($points, $functionName, $constraint, $answer, $testcases,1));
print("<br>");
print(outputGen($points, $functionName, $constraint, $answer, $testcases,2));
print("<br>");
print(outputGen($points, $functionName, $constraint, $answer, $testcases,3));
print("<br>");
$output2 = outputGen($points, $functionName, $constraint, $answer, $testcases, 4);
print($output2[0]);
print("<br>");
print($output2[1]);
print("<br>");
print($output2[2]);
print("<br>");
print($output2[3]);
print("<br>");
print($output2[4]);
print("<br>");
print($output2[5]);
print("<br>");
?>
