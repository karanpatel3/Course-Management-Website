<?php

//http://afsaccess1.njit.edu/~ajr74/autoGrade.php

$answer = "def sum(numbers):
    total = 0
    for x in numbers:
        total += x
    return total
print(sum((8, 2, 3, 0, 7)))";

$functionName = "sum";
$constraint = "while";

function checkColon($ans){
    $answer = $ans;
    $answerFile = fopen("/afs/cad.njit.edu/u/a/j/ajr74/public_html/answer.txt", "w+") or die("Unable to open file.");
    fwrite($answerFile, $answer);
    rewind($answerFile);
    $line = fgets($answerFile);

    if (strstr($line, ':')) {
        $output = ": found";
    } else {
        $output = "no : found";
    }

    fclose($answerFile);
    return $output;
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
    return $execResult;
}

function checkConstraint($cons, $ans){
    $answer = $ans;
    $constraint = $cons;

    if (strstr($answer, $constraint)) {
        $output = $constraint . " found";
    } else {
        $output = "no " . $constraint . " loop found";
    }

    return $output;
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
