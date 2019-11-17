<?php
include('DBconnect.php');

$Question= $_POST['problem'];

$Topic= $_POST['topic'];

$Difficulty=$_POST['difficulty'];

$FunctionName = $_POST['functionname'];

$Constraint = $_POST['constraint'];

$TestCase1=$_POST['test_case_1'];

$TestCase1OP=$_POST['testcase1op'];

$TestCase2=$_POST['test_case_2'];

$TestCase2OP=$_POST['testcase2op'];

$TestCase3=$_POST['test_case_3'];

$TestCase3OP=$_POST['testcase3op'];

$TestCase4=$_POST['test_case_4'];

$TestCase4OP=$_POST['testcase4op'];

$TestCase5=$_POST['test_case_5'];

$TestCase5OP=$_POST['testcase5op'];

$TestCase6=$_POST['test_case_6'];

$TestCase6OP=$_POST['testcase6op'];


$query = "INSERT INTO `kp486`.`Question_Bank` (`Question`, `FunctionName`, `Topic`, `Difficulty`, `Constraint`, `TestCase1`, `TestCase1OP`, `TestCase2`, `TestCase2OP`, `TestCase3`, `TestCase3OP`, `TestCase4`, `TestCase4OP`, `TestCase5`, `TestCase5OP`, `TestCase6`, `TestCase6OP`)VALUES ('$Question', '$FunctionName', '$Topic', '$Difficulty', '$Constraint', '$TestCase1', '$TestCase1OP', '$TestCase2', '$TestCase2OP', '$TestCase3', '$TestCase3OP', '$TestCase4', '$TestCase4OP', '$TestCase5', '$TestCase5OP', '$TestCase6', '$TestCase6OP')";

$fail = fail;
$success = success;

if ($conn->query($query) === TRUE) {
    echo json_encode($success);
} else {
    echo json_encode("Error: " . $query . "<br>" . $conn->error);
}
  $conn->close();
 
?>
