<?php
/*
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
$functionName = "add";
$constraint = "";
$testcases = array("\"-\",5,3.2", "\"+\",5,3.7", "\"*\",5,3.14", "\"/\",4,2.2", "\"/\",4,2.2", "\"/\",4,2.2");
*/

// create curl resource
$ch = curl_init();

// set url
curl_setopt($ch, CURLOPT_URL, "http://afsaccess1.njit.edu/~kp486/GetStudAnswers.php");

//return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// $output contains the output string
$output = curl_exec($ch);

// close curl resource to free up system resources
curl_close($ch);

$out = json_decode($output, true);

$SubmittedNum = sizeof($out);
$QID =
$testcases = [];
$payload = [];

function checkColon($ans)
{
    $answer = $ans;

    if(strstr($answer, "\n")){
        $line = strstr($answer, "\n", true);
    }else{
        $line = $answer;
    }
    if (strstr($line, ':')) {
        return true;
    } else {
        return false;
    }
}

function checkFuncName($funcName, $ans)
{
    $functionName = $funcName;

    if(strstr($functionName, "(")){
        $functionName = str_replace(array('(',')'), '', $functionName);
    }

    $funcFile = fopen("/afs/cad.njit.edu/u/a/j/ajr74/public_html/funcName.txt", "w") or die("Unable to open file.");
    $answer = $ans;
    fwrite($funcFile, $functionName);
    if (!checkColon($answer)) {
        $answerFile = fopen("/afs/cad.njit.edu/u/a/j/ajr74/public_html/answer.txt", "w") or die("Unable to open file.");
        $firstline = strstr($answer, "\n", true);
        $firstline = rtrim($firstline);
        $colon = ':';
        $newAnswer = str_replace($firstline, $firstline . $colon, $answer);
        fwrite($answerFile, $newAnswer);
    } else {
        $answerFile = fopen("/afs/cad.njit.edu/u/a/j/ajr74/public_html/answer.txt", "w") or die("Unable to open file.");
        fwrite($answerFile, $answer);
    }
    $execResult = shell_exec('python /afs/cad.njit.edu/u/a/j/ajr74/public_html/funCheck.py');
    fclose($answerFile);
    fclose($funcFile);
    $execResult = trim($execResult);
    if ($execResult == "Correct function name") {
        return true;
    } else {
        return false;
    }
}

function checkConstraint($cons, $ans)
{
    $answer = $ans;
    $constraint = $cons;
    if (strstr($answer, $constraint)) {
        return true;
    } else {
        return false;
    }
}

function checkTestcase($test, $ans)
{
    $testcase = $test;
    $answer = $ans;
    $funcName = shell_exec('python /afs/cad.njit.edu/u/a/j/ajr74/public_html/funcName.py');
    $funcName = trim($funcName);
    $split = explode(".", $testcase);
    $input = explode(",", $split[0]);
    $output = $split[1];
    $paraNum = sizeof($input);
    $runline = "";
    $quote = '"';

    echo "input[0]: " . $input[0] . "<br>";

    if($input[0]=='*' or $input[0]=='/' or $input[0]=='+' or $input[0]=='-'){
        $input[0] = $quote . $input[0] . $quote;
    }

    echo "input[0] after: " . $input[0] . "<br>";

    for ($x = 0; $x < $paraNum; $x++) {
        if ($x == 0) {
            $runline = $funcName . "(" . $input[$x];
        } else if ($x != $paraNum && $x != 0) {
            $runline = $runline . ',' . $input[$x];
        }
        if ($x == $paraNum - 1) {
            $runline = $runline . ")";
        }
    }
    $file = fopen("/afs/cad.njit.edu/u/a/j/ajr74/public_html/pythonExec.py", "w") or die("Unable to open file.");
    if (!checkColon($answer)) {
        $firstline = strstr($answer, "\n", true);
        $firstline = rtrim($firstline);
        $colon = ':';
        $newAnswer = str_replace($firstline, $firstline . $colon, $answer);
        $newAnswer = $newAnswer . "\n" . "print(" . $runline . ")";
        fwrite($file, $newAnswer);
    } else {
        $answer = $answer . "\n" . "print(" . $runline . ")";
        fwrite($file, $answer);
    }
    $pyOut = shell_exec('python /afs/cad.njit.edu/u/a/j/ajr74/public_html/pythonExec.py');
    $pyOut = trim($pyOut);

    //echo "Runline: ". $runline . "<br>";

    if ($pyOut != $output) {
        return false;
    } else {
        return true;
    }
}

function outputGen($inPoints, $funcName, $cons, $ans, $test, $ind)
{
    $points = $inPoints;
    $answer = $ans;
    $testcases = $test;
    $testOut = [];
    $functionName = $funcName;
    $constraint = $cons;
    $indicator = $ind;
    if (!checkColon($answer)) {
        $minus = floor($points * 0.10);
        if ($minus == 0) {
            $minus = 1;
        }
        $colonMsg = "No : in header, minus " . $minus . " points";
    }
    if (!checkFuncName($functionName, $answer)) {
        $minus = floor($points * 0.10);
        if ($minus == 0) {
            $minus = 1;
        }
        $funcNameMsg = "Incorrect function name, minus " . $minus . " points";
    }
    if (!empty($constraint) && $constraint!="None") {
        if (!checkConstraint($constraint, $answer)) {
            $minus = floor($points * 0.10);
            if ($minus == 0) {
                $minus = 1;
            }
            $constraintMsg = "No " . $constraint . " statement used in answer, minus " . $minus . " points";
        }
    }
    for ($x = 0; $x < sizeof($testcases); $x++) {
        if (!checkTestcase($testcases[$x], $answer)) {
            if (empty($constraint)) {
                $minus = floor($points * (0.80 / sizeof($testcases)));
                if ($minus == 0) {
                    $minus = 1;
                }
            } else {
                $minus = floor($points * (0.70 / sizeof($testcases)));
                if ($minus == 0) {
                    $minus = 1;
                }
            }
            array_push($testOut, "Testcase #" . ($x + 1) . " failed minus " . $minus . " points");
        }
    }
    if ($indicator == 1) {
        return $colonMsg;
    } elseif ($indicator == 2) {
        return $funcNameMsg;
    } elseif ($indicator == 3) {
        return $constraintMsg;
    } elseif ($indicator == 4) {
        return $testOut;
    } else {
        return "No indicator";
    }
}

function outputForm($id, $pnts, $funcName, $cons, $ans, $test){
    $answer = $ans;
    $functionName = $funcName;
    $points = $pnts;
    $constraint = $cons;
    $testcases = $test;
    $QID = $id;

    $outputArray = [];
    $outputArray[0] = $QID;
    $outputArray[1] = $points;
    $outputArray[2] = $answer;

    $minus = 0;
    $colonMessage = outputGen($points, $functionName, $constraint, $answer, $testcases, 1);
    $minus += preg_replace('/[^0-9]/', '', $colonMessage);
    $functionMessage = outputGen($points, $functionName, $constraint, $answer, $testcases, 2);
    $minus += preg_replace('/[^0-9]/', '', $functionMessage);
    $constraintMessage = outputGen($points, $functionName, $constraint, $answer, $testcases, 3);
    $minus += preg_replace('/[^0-9]/', '', $constraintMessage);
    $testMsgArray = outputGen($points, $functionName, $constraint, $answer, $testcases, 4);
    for ($x = 0; $x < sizeof($testcases); $x++) {
        $pointsOnly = explode("minus", $testMsgArray[$x]);
        $minus += preg_replace('/[^0-9]/', '', $pointsOnly[1]);
    }

    $outputArray[3] = $points - $minus;
    $outputArray[4] = $minus;

    if (!empty($colonMessage)) {
        array_push($outputArray, $colonMessage);
    }
    if (!empty($functionMessage)) {
        array_push($outputArray, $functionMessage);
    }
    if (!empty($constraintMessage)) {
        array_push($outputArray, $constraintMessage);
    }
    if (!empty($testMsgArray)) {
        for ($x = 0; $x < sizeof($testMsgArray); $x++) {
            array_push($outputArray, $testMsgArray[$x]);
        }
    }
    return $outputArray;
}


$comments = "";
$payArray = [];

for($x = 0; $x < $SubmittedNum; $x++){
    for($z = 0; $z < 6; $z++){
        $testin = $out[$x]["TestCase". $z];
        $testout = $out[$x]["TestCase" . $z . "OP"];
        if(!empty($testin) && !empty($testout)){
            $testcase = $testin . "." . $testout;
            array_push($testcases, $testcase);
        }
    }

    $outArray = outputForm($out[$x]["QID"], $out[$x]["Points"], $out[$x]["FunctionName"], $out[$x]["Constraint"], $out[$x]["StudentAnswer"], $testcases);

    for($t = 0; $t < sizeof($outArray); $t++){
        if($t>4){
            $comments = $comments . $outArray[$t] . "\n";
        }
    }

    $outArray[5] = $comments;

    for($n = 0; $n < 6; $n++){
        $payArray[$n] = $outArray[$n];
    }

    array_push($payload, $payArray);
    $comments = "";
    $payArray = array();
    $testcases = array();
    $outArray = array();
}

$payload = json_encode($payload);

echo $payload;

?>
