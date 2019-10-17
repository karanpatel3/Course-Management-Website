<?php

$servername = "mysql01.arcs.njit.edu";
$dbusername = "kp486";
$dbpassword = "7UOK2hjq";
$db = "kp486";
// Create connection
$conn = mysqli_connect($servername, $dbusername, $dbpassword, $db);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$login = file_get_contents('php://input');

$json_decode = json_decode($login, true);


$username = $json_decode['ucid'];
$password = $json_decode['pw'];


$sql = "SELECT `role` FROM `login` WHERE `username` = '$username' AND `password` = '$password'";


$data = mysqli_query($conn, $sql);

$result = mysqli_fetch_assoc($data);


if(!$data) {
 echo json_encode($result);
 echo json_encode(array("response"=>"error"));

}

echo json_encode($result);


mysqli_close($conn);


?>
