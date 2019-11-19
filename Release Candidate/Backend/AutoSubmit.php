<?php

//this program is meant to take in the input of an array of Autograded Results from the middle end and send it to the back end table

include('DBconnect.php'); //includes separate script to connect to database

$input= file_get_contents('php://input'); //receives input from front end

$json_decode = json_decode($input, true); //decodes the json passed into this file into an array

foreach($json_decode as $item) { //foreach loop meant to iterate through the array

$result  = $conn -> query("INSERT INTO `kp486`.`AutoGradedExam` (`QID`, `StudentAnswer`, `AutoComments`, `Points`, `DeductPoints`) VALUES ('".$item['QID']."', '".$item['StudentAnswer']."', '".$item['AutoComments']."', '".$item['Points']."', '".$item['DeductPoints']."')"); //runs query and inserts the rows into the database
     } 
     
     //echo $result;
     
$fail = fail; //variable to print fail

$success = success; //variable to print success

if ($result === TRUE) { //if query worked, then print success
    echo json_encode($success);

} else { //else print failed
    echo json_encode("Error: " . $query . "<br>" . $conn->error);
}
$conn->close();
