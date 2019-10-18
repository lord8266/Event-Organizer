<?php
require 'server/database_utility.php';
require 'server/session_utility.php';

$data_user= check_cookie();
$loggedIn = $data_user!=NULL;
$data_event = get_event_details($_GET["event_id"]);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $data_event["name"] ?></title>
    <link rel="stylesheet" href="css/frameworks/materialize.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/navbar.css">
</head>
<body>
    <?php 
        if ($loggedIn) {
            echo strtr(file_get_contents("defaults/navbar_loggedin.html"),array('$username' => $data_user["username"]));
        }
        else {
            echo file_get_contents("defaults/navbar_loggedout.html");
        }
    ?>

    

    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <?php
    if ($loggedIn) {
        echo "<script>".file_get_contents("defaults/navbar_loggedin.js")."</script>";
    }
    ?>
</body>
</html>