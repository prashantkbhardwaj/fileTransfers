<?php
$host="torrents.cgqki5jfax3b.us-east-2.rds.amazonaws.com";
$user="root";
$pass="rootpassword";
$db="torrents";

$conn = new mysqli($_SERVER['RDS_HOSTNAME'], $_SERVER['RDS_USERNAME'], $_SERVER['RDS_PASSWORD'], $_SERVER['RDS_DB_NAME'], $_SERVER['RDS_PORT']);
$status=0;


$torrentId = $_POST["torrentId"];
if(empty($torrentId))
{
    $results+=["status" => $status];
    echo json_encode($results);
    exit();
}

$query = "SELECT torrentName,torrentPath,torrentHash,torrentSize,noOfPieces FROM torrentList WHERE torrentList.torrentID = ? ";
$getDetails = $conn->prepare($query);
$getDetails->bind_param("i",$torrentId);
$getDetails->execute();

$getDetails->bind_result($torrentName,$torrentPath,$torrentHash,$torrentSize,$noOfPieces);
$getDetails->fetch();
$getDetails->close();
if(empty($torrentName))
{
    $status = 0;
}
else
{
    $status = 1;
}
$inresults=[];
$inresults+=["torrentId"=>$torrentId];
$inresults+=["name" => $torrentName];
$inresults+=["hash" => $torrentHash];
$inresults+=["size" => $torrentSize];
$inresults+=["path" => $torrentPath];
$inresults+=["noOfPieces" => $noOfPieces];
$results=[];
$results+=["status" => $status];
$results+=["data" => $inresults];
echo json_encode($results);


?>
