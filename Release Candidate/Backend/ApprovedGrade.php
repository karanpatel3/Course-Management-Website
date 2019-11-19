<?php

include('DBconnect.php'); //includes separate script to connect to database

$input= file_get_contents('php://input'); //receives input from front end

$json_decode = json_decode($input, true); //decodes the json passed into this file into an array

echo var_dump($json_decode);

foreach($json_decode as $item) { //foreach loop meant to iterate through the array

       $result  = $conn -> query("INSERT INTO `kp486`.`ViewGradedExam` (`Question`, `MaxPoints`, `GivenAnswer`, `PointsReceived`, `DeductedPoints`, `Comment`, `Feedback`) VALUES ('".$item['Question']."', '".$item['Points']."', '".$item['Answer']."', '".$item['DeductPoints']."', '".$item['PointsReceived']."', '".$item['AutoComments']."', '".$item['TeacherComments']."')"); //runs query and inserts the rows into the database
     } 
     
$fail = fail; //variable to print fail

$success = success; //variable to print success


if ($result === TRUE) { //if query worked, then print success
    echo json_encode($success);

} else { //else print failed
    echo json_encode("Error: " . $query . "<br>" . $conn->error);
}
$conn->close();

?>
