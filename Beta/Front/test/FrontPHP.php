<?php
{
// echo $payload;
  $userName = $_POST["ucid"];
  $password = $_POST["pass"];
  $result = array("ucid" => $userName,"pass" => $password);
  echo $userName;
  echo $result;
// echo $result;
  $ch = curl_init("http://afsaccess1.njit.edu/~kp486/BetaLogin2.php");
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $result);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  $Val = curl_exec($ch);
  // echo $Val;
  curl_close($ch);
  // echo $Val;
}
//echo "ucid = " . $userName . '   ';
//echo "pass = " . $password ;
?>
