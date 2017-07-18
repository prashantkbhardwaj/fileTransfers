<?php require_once("includes/db_connection.php");?>
<?php require_once("includes/functions.php");?>

<?php
    
    $username = $_POST["username"];
    $password = $_POST["password"];
    $response = array();
    $response["success"] = false; 

    $found_user = attempt_login($username, $password);

    if ($found_user) {
        $response["success"] = true;  
        $response["name"] = $name;
        $response["username"] = $username;
        $response["password"] = $password;
        echo json_encode($response);
    }
?>