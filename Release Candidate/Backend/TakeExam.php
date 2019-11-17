<?php
// create connection

include ('DBconnect.php');

$sql = "SELECT `Question`, `Points` FROM Question_Bank INNER JOIN New_exam ON Question_Bank.QID = New_exam.QID";
$results_array = array();
$result = mysqli_query($conn,$sql);

while ($row = $result->fetch_assoc()) {
    $results_array[] = $row;
}

echo json_encode($results_array);

?>
