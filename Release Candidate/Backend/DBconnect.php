<?php
//connect to database, works completely fine no need to edit

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
?>
