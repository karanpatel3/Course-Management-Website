<?php

$answer = "def sum(numbers):
    total = 0
    for x in numbers:
        total += x
    return total
print(sum((8, 2, 3, 0, 7)))";

$points = 10;

$functionName = "sum";
$constraint = "for";

$testcase1 = "0";
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

function checkTestCases($answer, $testcase1, $testcase2, $testcase3, $testcase4, $testcase5, $testcase6){

}

$i = 1;

$output = checkColon($answer);
$output2 = checkFuncName($functionName, $answer);
$output3 = checkConstraint($constraint, $answer);
$output4 = output($points, $functionName, $constraint, $answer, $i);
print($output . "Colon: ");
print("<br>");
print($output2 . "Function Name");
print("<br>");
print($output3 . "Constraint");
print("<br>");
print($output4);
?>
