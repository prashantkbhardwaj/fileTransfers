<?php
 	if($_SERVER['REQUEST_METHOD']=='POST'){
 
	 	$image = $_POST['image'];
	    $uploader = $_POST['uploader'];
	    $level1 = $_POST['level1'];
	    $level2 = $_POST['level2'];
	    $level3 = $_POST['level3'];
	    $pictureName = $_POST['picturename'];
	    $sessionName = $_POST['sessionname'];
	    $timeDuration = $_POST['timeduration'];
	    $qrcode = $_POST['qrcode'];
	  	require_once("includes/db_connection.php");
	 	$id = date("Ymdhis");
	 	date_default_timezone_set("Asia/Kolkata");
		$dateUpload = date("d M, Y | h:i a");
	 	$path = "uploads/$id.png";

	 	$query = "SELECT MAX(pos) FROM volleyupload";
	 	$result = mysqli_query($conn, $query);
	 	$list = mysqli_fetch_assoc($result);
	 	$pos = $list['pos'] + 1;

	 	$actualpath = "http://192.168.1.103/fileTransfers/teqniHome/$path";
	 	$sql = "INSERT INTO volleyupload (imgPath, uploader, level1, level2, level3, pictureName, sessionName, timeDuration, dateUpload, qrcode, pos) VALUES ('{$actualpath}','{$uploader}', '{$level1}', '{$level2}', '{$level3}', '{$pictureName}', '{$sessionName}', '{$timeDuration}', '{$dateUpload}', '{$qrcode}', '{$pos}')";
		if(mysqli_query($conn,$sql)){
		 	file_put_contents($path,base64_decode($image));
		 	echo "Successfully Uploaded";
		}
	 	mysqli_close($conn);
	}else{
	 	echo "Error";
	}
?>