<?php

//this program is meant to take in the input of an array of QIDs and Points from the front end and send it to the back end table, the array that is being passed back is an associative array

include('DBconnect.php'); //includes separate script to connect to database

$input= file_get_contents('php://input'); //receives input from front end

$json_decode = json_decode($input, true); //decodes the json passed into this file into an array

foreach($json_decode as $item) { //foreach loop meant to iterate through the array

$result  = $conn -> query("INSERT INTO `kp486`.`TakenExam` (`Question`, `Points`, `StudentAnswer`) VALUES ('".$item['Question']."', '".$item['Points']."', '".$item['Answer']."')"); //runs query and inserts the rows into the database
     } 
     
     //echo $result;
     
$fail = fail; //variable to print fail

$success = success; //variable to print success

if ($result === TRUE) { //if query worked, then print success
    echo json_encode($success);

} else { //else print failed
    echo json_encode("Error: " . $query . "<br>" . $conn->error);
}


// create curl resource
$ch = curl_init();

// set url
curl_setopt($ch, CURLOPT_URL, "http://afsaccess1.njit.edu/~ajr74/TESTINGONLY.php");

//return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// $output contains the output string
$output = curl_exec($ch);

// close curl resource to free up system resources
curl_close($ch);

echo var_dump($output);

$json_decode1 = json_decode($output, true); //decodes the json passed into this file into an array

foreach($json_decode1 as $item) { //foreach loop meant to iterate through the array

$result  = $conn -> query("INSERT INTO `kp486`.`AutoGradedExam` (`QID`, `MaxPoints`, `StudentAnswer`, `PointsAwarded`, `DeductPoints`, `AutoComments`) VALUES ('".$item[0]."', '".$item[1]."', '".$item[2]."', '".$item[3]."', '".$item[4]."', '".$item[5]."')"); //runs query and inserts the rows into the database
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

?>
