<?php
include ('connectSQL.php'); //connects to db

$query = 'SELECT * FROM Question_Bank'; //select statement
$results_array = array();
$result = mysqli_query($conn,$query);

while ($row = $result->fetch_assoc()) {  //while each row has a result, fetches information in row
    $results_array[] = $row; //stores results found in rows in array
}

echo json_encode($results_array);

?>
