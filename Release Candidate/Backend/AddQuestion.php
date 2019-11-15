<?php
include('DBconnect.php');
$Question= $_POST['problem'];
$Topic= $_POST['topic'];
$Difficulty=$_POST['difficulty'];
$TestCase1=$_POST['test_case_1'];
$TestCase2=$_POST['test_case_2'];
$query = "INSERT INTO `kp486`.`Question_Bank` (`Question`, `Topic`, `Difficulty`, `TestCase1`, `TestCase2`)VALUES ('$Question', '$Topic', '$Difficulty', '$TestCase1', '$TestCase2')";
$fail = fail;
$success = success;
if ($conn->query($query) === TRUE) {
    echo json_encode($success);
} else {
    echo json_encode("Error: " . $query . "<br>" . $conn->error);
}
  $conn->close();
 
?>
