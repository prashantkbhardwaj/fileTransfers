<?php require_once("includes/db_connection.php");?>
<?php require_once("includes/functions.php");?>
<?php
	$query = "SELECT * FROM volleyupload";
	$result = mysqli_query($conn, $query);
	$i = 0;
	$response = array();
	while ($list = mysqli_fetch_assoc($result)) {
		$response[$i]['image'] = $list['imgPath'];
		$i = $i+1;
	}
	echo json_encode($response);
?>