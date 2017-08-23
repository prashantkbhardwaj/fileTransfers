<?php
 	if($_SERVER['REQUEST_METHOD']=='POST'){
 
	    $uploader = $_POST['uploader'];
	    $level1 = $_POST['level1'];
	    $level2 = $_POST['level2'];
	    $level3 = $_POST['level3'];
	    $sessionName = $_POST['sessionName'];
	  	require_once("includes/db_connection.php");
	 	$sql = "INSERT INTO volleyupload (uploader, level1, level2, level3, sessionName) VALUES ('{$uploader}', '{$level1}', '{$level2}', '{$level3}', '{$sessionName}')";
		if(mysqli_query($conn,$sql)){
		 	echo "Successfully Created";
		}
	 	mysqli_close($conn);
	}else{
	 	echo "Error";
	}
?>