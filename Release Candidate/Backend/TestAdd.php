<?php

//this program is meant to take in the input of an array of QIDs and Points from the front end and send it to the back end table, the array that is being passed back is an associative array

include('DBconnect.php'); //includes separate script to connect to database

$input= file_get_contents('php://input'); //receives input from front end

$json_decode = json_decode($input, true); //decodes the json passed into this file into an array

//$query = "INSERT INTO `kp486`.`New_exam1` (`QID`, `Points`) VALUES ('".$json_decode['QID']."', '".$json_decode['Points']."')"; //query to insert QID and Points of each row into the database



foreach($json_decode as $item) { //foreach loop meant to iterate through the array

       $result  = $conn -> query("INSERT INTO `kp486`.`New_exam` (`QID`, `Points`) VALUES ('".$item['QID']."', '".$item['Points']."')"); //runs query and inserts the rows into the database
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
