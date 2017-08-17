<?php
 	if($_SERVER['REQUEST_METHOD']=='POST'){
 
	 	$video = $_POST['video'];
	 	$videx = explode("/", $video);
	 	$video = $videx[6];
	    $uploader = $_POST['uploader'];
	    $level1 = $_POST['level1'];
	    $level2 = $_POST['level2'];
	    $level3 = $_POST['level3'];
	    $pictureName = $_POST['picturename'];
	    $sessionName = $_POST['sessionname'];
	    $qrcode = $_POST['qrcode'];
	  	require_once("includes/db_connection.php");
	 	$id = date("Ymdhis");
	 	date_default_timezone_set("Asia/Kolkata");
		$dateUpload = date("d M, Y | h:i a");
	 	$path = "uploads/$video";
	 	$actualpath = "http://192.168.1.102/fileTransfers/teqniHome/$path";
	 	$sql = "INSERT INTO volleyupload (imgPath, uploader, level1, level2, level3, pictureName, sessionName, timeDuration, dateUpload, qrcode) VALUES ('{$actualpath}','{$uploader}', '{$level1}', '{$level2}', '{$level3}', '{$pictureName}', '{$sessionName}', '0', '{$dateUpload}', '{$qrcode}')";
		if(mysqli_query($conn,$sql)){
		 	echo "Successfully Uploaded";
		}
	 	mysqli_close($conn);
	}else{
	 	echo "Error";
	}
?>