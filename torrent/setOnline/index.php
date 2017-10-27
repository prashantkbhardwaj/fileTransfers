<?php

$host="localhost";
$user="root";
$pass="root";
$db="torrents";


$conn = new mysqli($_SERVER['RDS_HOSTNAME'], $_SERVER['RDS_USERNAME'], $_SERVER['RDS_PASSWORD'], $_SERVER['RDS_DB_NAME'], $_SERVER['RDS_PORT']);
$one = 1;
error_reporting(1);
$clientIP = $_SERVER['REMOTE_ADDR'];

if (strcmp("127.0.0.1",$clientIP)==0)
{
	$clientIP = "192.168.43.113";
}

echo $one;
echo "Client IP".$clientIP;
$query = "UPDATE swarms SET seederOnline = 1,seederLastRequestTime = ? WHERE seederIP LIKE ?";
$addSeeder = $conn->prepare($query);
$date = date("Y:m:d H:i:s");
echo $date;
$addSeeder->bind_param("ss",$date,$clientIP);
if($addSeeder->execute())
{
	echo "Executed";
}
$addSeeder->close();


?>
