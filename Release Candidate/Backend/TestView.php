<?php

//for viewing questions out of the question bank

include ('DBconnect.php');

$query = 'SELECT * FROM Question_Bank';
$results_array = array();
$result = mysqli_query($conn,$query);

while ($row = $result->fetch_assoc()) {
    $results_array[] = $row;
}

echo json_encode($results_array);

?>
