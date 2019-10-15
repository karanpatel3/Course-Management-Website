<?php

$user = $_POST["username"];
$pass = $_POST["pass"];

$dbResponse = loginDB($user, md5($pass));
echo json_encode($dbResponse);

function loginDB($user, $pass) {
    $data = array('username'=>$user, 'password'=>$pass);
    $url = 'DB';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $Response = curl_exec($ch);
    curl_close($ch);
    return $Response;
}
?>
