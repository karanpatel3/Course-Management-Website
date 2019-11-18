<?php
// create connection

//this is for viewing questions out of the question bank, it works completely fine, no need to edit

include ('DBconnect.php');

$query = 'SELECT `StudentAnswer`, `Points`, `FunctionName`, `Constraint`, `TestCase1`, `TestCase1OP`, `TestCase2`, `TestCase2OP`, `TestCase3`, `TestCase3OP`, `TestCase4`, `TestCase4OP`, `TestCase5`, `TestCase5OP`, `TestCase6`, `TestCase6OP` FROM TakenExam INNER JOIN Question_Bank ON Question_Bank.Question = TakenExam.Question';
$results_array = array();
$result = mysqli_query($conn,$query);

while ($row = $result->fetch_assoc()) {
    $results_array[] = $row;
}

echo json_encode($results_array);

?>
