<?php

  $userName = $_POST["ucid"];
  $password = $_POST["pass"];
  $d = array("username" => $userName,"pass" => $password);


  $ch = curl_init("http://afsaccess1.njit.edu/~kp486/BetaLogin.php");
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $d);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  $Val = curl_exec($ch);
  curl_close($ch);
  echo $Val;
?>
