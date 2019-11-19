<?php
// create connection

//for viewing graded exam on student side

include ('DBconnect.php');

$query = 'SELECT * FROM `ViewGradedExam`';
$results_array = array();
$result = mysqli_query($conn,$query);

while ($row = $result->fetch_assoc()) {
    $results_array[] = $row;
}

echo json_encode($results_array);

?>
