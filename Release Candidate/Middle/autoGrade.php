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
$functionName = "operation";
$constraint = "";
$testcases = array("\"-\",5,3.2", "\"+\",5,3.8", "\"*\",5,3.15", "\"/\",4,2.2", "\"/\",4,2.2", "\"/\",4,2.2");

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

    $file = fopen("/afs/cad.njit.edu/u/a/j/ajr74/public_html/pythonExec.py", "w") or die("Unable to open file.");

    if(!checkColon($answer)){
        $firstline = strstr($answer,"\n",true);
        $firstline = rtrim($firstline);
        $colon =':';
        $newAnswer = str_replace($firstline, $firstline.$colon, $answer);
        $newAnswer = $newAnswer . "\n" . "print(" . $runline . ")";
        fwrite($file, $newAnswer);
    }else{
        $answer = $answer . "\n" . "print(" . $runline . ")";
        fwrite($file, $answer);
    }

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
    $indicator = $ind;

    if(!checkColon($answer)){
        $minus = floor($points*0.10);
        if($minus == 0){
            $minus = 1;
        }
        $colonMsg = "No : in header, minus " . $minus . " points";
    }
    if(!checkFuncName($functionName, $answer)){
        $minus = floor($points*0.10);
        if($minus == 0){
            $minus = 1;
        }
        $funcNameMsg = "Incorrect function name, minus " . $minus . " points";
    }
    if(!empty($constraint)){
        if(!checkConstraint($constraint, $answer)){
            $minus = floor($points*0.10);
            if($minus == 0){
                $minus = 1;
            }
            $constraintMsg = "No " . $constraint . " statement used in answer, minus " . $minus . " points";
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

function outputForm($pnts, $funcName, $cons, $ans, $test){

    $answer = $ans;
    $functionName = $funcName;
    $points = $pnts;
    $constraint = $cons;
    $testcases = $test;
    $outputArray = [];

    $minus = 0;

    $colonMessage = outputGen($points, $functionName, $constraint, $answer, $testcases, 1);
    $minus += preg_replace('/[^0-9]/', '', $colonMessage);
    $functionMessage = outputGen($points, $functionName, $constraint, $answer, $testcases, 2);
    $minus += preg_replace('/[^0-9]/', '', $functionMessage);
    $constraintMessage = outputGen($points, $functionName, $constraint, $answer, $testcases, 3);
    $minus += preg_replace('/[^0-9]/', '', $constraintMessage);
    $testMsgArray = outputGen($points, $functionName, $constraint, $answer, $testcases, 4);

    for($x = 0; $x < sizeof($testcases); $x++){
        $pointsOnly = explode("minus", $testMsgArray[$x]);
        $minus += preg_replace('/[^0-9]/', '', $pointsOnly[1]);
    }


    if(!empty($colonMessage)){
        array_push($outputArray, $colonMessage);
    }
    if(!empty($functionMessage)){
        array_push($outputArray, $functionMessage);
    }
    if(!empty($constraintMessage)){
        array_push($outputArray, $constraintMessage);
    }
    if(!empty($testMsgArray)){
        for($x = 0; $x < sizeof($testMsgArray); $x++){
            array_push($outputArray, $testMsgArray[$x]);
        }
    }

    array_push($outputArray, $minus);
    return $outputArray;
}

$outArray = outputForm($points, $functionName, $constraint, $answer, $testcases);

for($x = 0; $x < sizeof($outArray); $x++){
    print($outArray[$x]);
    print("<br>");
}
?>
