<?php

/*
$description = $_POST["description"];
$answer = $_POST["answer"];
$totalPoints = $_POST['totalPoints'];
$testCase1 = $_POST['testCase1'];
$testCase2 = $_POST['testCase2'];
*/

$answer = 'num1 = 15
num2 = 12

sum = num1 + num2

print("Sum of {0} and {1} is {2}".format(num1, num2, sum))';

$testCase1 = '+';
$testCase2 = 'Sum of 15 and 12 is 27';
$totalPoints = 10;

if(strpos($answer,$testCase1)==false){
    $totalPoints -= 5;
    echo "epic fail";
}

$file = fopen("/afs/cad.njit.edu/u/a/j/ajr74/public_html/pythonExec.py", "w") or die("Unable to open file.");

fwrite($file, $answer);

$execResult = exec('python /afs/cad.njit.edu/u/a/j/ajr74/public_html/pythonExec.py');

fclose($file);

if($execResult!=$testCase2){
    echo "wrong answer";
}

//string searching
//php exec

?>
