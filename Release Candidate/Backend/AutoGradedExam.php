<?php
// create connection

//this is for viewing results of autograder from table

include ('DBconnect.php');

$query = 'SELECT `Question`, `StudentAnswer`, `AutoComments`, `MaxPoints`, `PointsAwarded`, `DeductPoints` FROM AutoGradedExam INNER JOIN Question_Bank ON Question_Bank.QID = AutoGradedExam.QID';
$results_array = array();
$result = mysqli_query($conn,$query);

while ($row = $result->fetch_assoc()) {
    $results_array[] = $row;
}

echo json_encode($results_array);

?>
