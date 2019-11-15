<?php
$answer = "def operation(op, a, b):
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
$points = 10;
$functionName = "operation";
$constraint = "";
$testcase1 = "\"-\",5,3/2";
$testcase2 = "0";
$testcase3 = "0";
$testcase4 = "0";
$testcase5 = "0";
$testcase6 = "0";

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

    $split = explode("/", $testcase);

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

function output($inPoints, $funcName, $cons, $ans, $ind){
    $points = $inPoints;
    $answer = $ans;
    $functionName = $funcName;
    $constraint = $cons;
    $wrongCounter = 0;
    $indicator = $ind;
    if(!checkColon($answer)){
        $minus = ceil($points*0.10);
        $colonMsg = "No : in header, minus " . $minus . " points";
        $wrongCounter++;
    }
    if(!checkFuncName($functionName, $answer)){
        $minus = ceil($points*0.10);
        $funcNameMsg = "Incorrect function name, minus " . $minus . " points";
        $wrongCounter++;
    }
    if(!checkConstraint($constraint, $answer)){
        $minus = ceil($points*0.10);
        $constraintMsg = "No " . $constraint . " statement used in answer, minus " . $minus . " points";
        $wrongCounter++;
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
        }else{
            return "No indicator";
        }
    }
}

$out = checkFuncName($functionName, $answer);
$out2 = checkTestcase($testcase1, $answer);
print("<br>");
print($out2 . "Testcase");
print("<br>");
print("<br>");
?>
