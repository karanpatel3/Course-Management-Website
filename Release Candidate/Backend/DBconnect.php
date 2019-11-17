<?php
//connect to database, works completely fine no need to edit

$servername = "mysql01.arcs.njit.edu"; //servername goes here
$dbusername = ""; //username goes here
$dbpassword = ""; //password goes here
$db = ""; //database goes here
// Create connection
$conn = mysqli_connect($servername, $dbusername, $dbpassword, $db);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
