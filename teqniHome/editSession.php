<?php require_once("includes/db_connection.php");?>
<?php require_once("includes/functions.php");?>

<?php
    if ($_POST['sessionName']!="") {
        $uploader = $_POST['uploader'];
        $sessionName = $_POST['sessionName'];
        $oldSession = $_POST['oldSession'];
        $level1 = $_POST['level1'];
        $level2 = $_POST['level2'];
        $level3 = $_POST['level3'];

        $qrCode = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=".$level1."_".$level2."_".$level3."_".$sessionName.;
        echo $qrCode;
        
        $query = "UPDATE volleyupload SET sessionName = '{$sessionName}', level1 = '{$level1}', level2 = '{$level2}', level3 = '{$level3}' WHERE uploader = '{$uploader}' AND sessionName = '{$oldSession}'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $response = array();
            $response["success"] = true;  
            echo json_encode($response);     
        } 
    }
?>