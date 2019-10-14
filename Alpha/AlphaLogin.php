<?php


$username = $_POST['username']; //receives username and password from middle
$password = $_POST['password'];

$servername = "mysql01.arcs.njit.edu"; //server and db creds
$dbusername = "kp486";
$dbpassword = "XXXX";
$db = "kp486";

// Create connection
$conn = mysqli_connect($servername, $dbusername, $dbpassword, $db); //connects to njit db
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}



$hashpassword = md5($password);

$query = "SELECT * FROM `login` WHERE `username` LIKE '%$username%' AND `password` LIKE '%$hashpassword%';"; //query

$rolequery = "SELECT `role` FROM `login` WHERE `username` LIKE '%$username%' AND `password` LIKE '%$hashpassword%';";

$data = mysqli_query($conn, $query);

if(!$data)
{
echo mysqli_error($conn);
}
else
{
$res = $conn->query($query);

$roleres = $conn->query($rolequery);

while($row=$res->fetch_assoc())
{



$json_array[] = $row;

}

while($row=$roleres->fetch_assoc())
{



$json_array2[] = $row;

}

mysqli_close($conn);

if(empty($json_array))
{
echo $jj= json_encode('DB NOT ACCEPTED');
}
else
{
echo $jj = json_encode('DB ACCEPTED');
}

if(empty($json_array2))
{
echo $jj2= json_encode($json_array2);
}
else
{
echo $jj2 = json_encode($json_array2);
}

}


?>
