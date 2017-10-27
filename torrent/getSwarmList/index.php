<?php
/**
 * Created by PhpStorm.
 * User: jude
 * Date: 11/10/16
 * Time: 7:29 PM
 */
$host="torrents.cgqki5jfax3b.us-east-2.rds.amazonaws.com";
$user="root";
$pass="rootpassword";
$db="torrents";;


$conn = new mysqli($_SERVER['RDS_HOSTNAME'], $_SERVER['RDS_USERNAME'], $_SERVER['RDS_PASSWORD'], $_SERVER['RDS_DB_NAME'], $_SERVER['RDS_PORT']);
$seederList = [];
$torrentID = $_POST["torrentID"];
$query = "SELECT seederIP FROM swarms WHERE torrentID = ? AND seederOnline = 1";
$getList= $conn->prepare($query);
$getList->bind_param("i",$torrentID);
$getList->execute();
$getList->bind_result($seederIP);
$seederCount=0;
$clientIP = $_SERVER['REMOTE_ADDR'];
$addtoSwarm = true;
while($getList->fetch()) {
    $seederCount++;
    $seederList += [$seederCount => $seederIP];
    if (strcmp($seederIP, $clientIP) == 0) {
        $addtoSwarm = false;
    }
}

$getList->close();
$results =[];
$results+=["seederCount"=>$seederCount];
$results+=["seeders" => $seederList];
if($addtoSwarm)
{
	$query = "INSERT INTO swarms (torrentID,seederIP,seederOnline,seederLastRequestTime) VALUES (?,?,?,?)";
$addSeeder = $conn->prepare($query);
$date = date("Y:m:d H:i:s");
$addSeeder->bind_param("isis",$torrentId,$clientIP,$one,$date);
$addSeeder->execute();
$addSeeder->close();
}
echo json_encode($results);
