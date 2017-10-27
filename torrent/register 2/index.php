<?php
$host="localhost";
$user="root";
$pass="root";
$db="torrents";

$conn = new mysqli($host,$user,$pass,$db);

$torrentId=-1;
$one =1;
$fileName = $_POST["fileName"];
$filePath = $_POST["filePath"];
$fileSize = $_POST["fileSize"];
$sha1 = $_POST["sha1"];
$pieceNumbers = $_POST["pieceNumbers"];
$query = "INSERT INTO torrentList(torrentName,torrentPath,torrentHash,torrentSize,noOfPieces) VALUES (?,?,?,?,?)";
$addTorrent = $conn->prepare($query);
$addTorrent->bind_param("sssii",$fileName,$filePath,$sha1,$fileSize,$pieceNumbers);
$addTorrent->execute();
$torrentId = $conn->insert_id;
$addTorrent->close();
if($torrentId>0)
{
$clientIP = $_SERVER['REMOTE_ADDR'];
$query = "INSERT INTO swarms (torrentID,seederIP,seederOnline,seederLastRequestTime) VALUES (?,?,?,?)";
$addSeeder = $conn->prepare($query);
$date = date("Y:m:d H:i:s");
$addSeeder->bind_param("isis",$torrentId,$clientIP,$one,$date);
$addSeeder->execute();
$addSeeder->close();
}
echo $torrentId;
?>
