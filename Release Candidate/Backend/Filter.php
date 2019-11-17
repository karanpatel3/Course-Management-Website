<?php
include ('DBconnect.php');

$Keyword = $_POST['keyword'];


$Difficulty= $_POST['difficulty'];


$Topic= $_POST['topic'];


$query = "SELECT `QID`, `Question`, `Topic`, `Difficulty` FROM Question_Bank WHERE `Question` LIKE '%$Keyword%' AND `Difficulty`='$Difficulty' AND `Topic` = '$Topic'";


$results_array = array();
$result = mysqli_query($conn,$query);

while ($row = $result->fetch_assoc()) {
    $results_array[] = $row;
}

echo json_encode($results_array);


?>
