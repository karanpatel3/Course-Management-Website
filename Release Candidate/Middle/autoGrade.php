<?php

$answer = "def sum(numbers):
    total = 0
    for x in numbers:
        total += x
    return total
print(sum((8, 2, 3, 0, 7)))";

$points = 10;

$functionName = "sum";
$constraint = "while";

function checkColon($ans){
    $answer = $ans;
    $answerFile = fopen("/afs/cad.njit.edu/u/a/j/ajr74/public_html/answer.txt", "w+") or die("Unable to open file.");
    fwrite($answerFile, $answer);
    rewind($answerFile);
    $line = fgets($answerFile);

    fclose($answerFile);

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
    $answerFile = fopen("/afs/cad.njit.edu/u/a/j/ajr74/public_html/answer.txt", "w") or die("Unable to open file.");

    fwrite($funcFile, $functionName);
    fwrite($answerFile, $answer);

    $execResult = shell_exec('python /afs/cad.njit.edu/u/a/j/ajr74/public_html/funCheck.py');

    fclose($answerFile);
    fclose($funcFile);

    if($execResult = "Correct function name"){
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

function output($inPoints, $funcName, $cons, $ans){
    $points = $inPoints;
    $answer = $ans;
    $functionName = $funcName;
    $constraint = $cons;
    $wrongCounter = 0;

    if(checkColon($answer)){
        $minus = ceil($points*0.10);
        $colonMsg = "No : in header, minus " . $minus . " points";
        wrongCounter++;
    }
    if(checkConstraint($constraint, $answer)){
        $minus = ceil($points*0.10);
        $constraintMsg = "No" . $constraint . " loop used in answer, minus " . $minus . " points";
        wrongCounter++;
    }
    if(checkFuncName($functionName, $answer)){
        $minus = ceil($points*0.10);
        $funcNameMsg = "Incorrect function name, minus " . $minus . " points";
        wrongCounter++;
    }
}


$output = checkColon($answer);
$output2 = checkFuncName($functionName, $answer);
$output3 = checkConstraint($constraint, $answer);

print($output);
print("<br>");
print($output2);
print("<br>");
print($output3);
print("<br>");

?>
