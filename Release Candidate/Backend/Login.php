<?php

include('DBconnect.php');

$login = file_get_contents('php://input');

$json_decode = json_decode($login, true);

$user = $json_decode['username'];

$pass = $json_decode['password'];

$sql = "SELECT `type` FROM `beta_login` WHERE `username`='$user' AND `password`='$pass'";

$data = mysqli_query($conn, $sql);

$result = mysqli_fetch_assoc($data);

if(!$data) {
 echo json_encode(array("response"=>"error"));
}

echo json_encode($result);

mysqli_close($conn);

?>
