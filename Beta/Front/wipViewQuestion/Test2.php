<?php
//testing view question by id
$data = array('id'=>'1');
$url = 'http://afsaccess1.njit.edu/~kp486/TestView.php';
$ch = curl_init();
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
$Response = curl_exec($ch);
curl_close($ch);

echo $Response;
?>
