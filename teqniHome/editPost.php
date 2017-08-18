<?php require_once("includes/db_connection.php");?>
<?php require_once("includes/functions.php");?>

<?php
    if ($_POST['postid']!="") {
        $postid = $_POST['postid']; 
        $name = $_POST['name'];
        $timeDuration = $_POST['timeDuration'];
        $pos = $_POST['pos'];
        
        $query = "UPDATE volleyupload SET pictureName = '{$name}', timeDuration = '{$timeDuration}', pos = '{$pos}' WHERE id = '{$postid}' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $response = array();
            $response["success"] = true;  
            echo json_encode($response);     
        } 
    }
?>