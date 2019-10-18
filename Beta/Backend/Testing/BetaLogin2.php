<?php

include('connectSQL.php');

$login = file_get_contents('php://input');

//echo $login;

//echo file_get_contents('php://input');


$json_decode = json_decode($login, true);

//echo var_dump($login);
//echo var_dump($json_decode);

$user = $json_decode['username'];

$pass = $json_decode['password'];

//echo var_dump($user);
//echo $user;
//echo var_dump($pass);

$sql = "SELECT `type` FROM `beta_login` WHERE `username`='$user' AND `password`='$pass'";


$data = mysqli_query($conn, $sql);

$result = mysqli_fetch_assoc($data);


if(!$data) {

 echo json_encode(array("response"=>"error"));

}

echo json_encode($result);


mysqli_close($conn);


?>
