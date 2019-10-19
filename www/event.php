<?php
require 'server/database_utility.php';
require 'server/session_utility.php';

$data_user= check_cookie();
$loggedIn = $data_user!=NULL;
$data_event = get_event_details($_GET["event_id"]);
setcookie("event_id",$_GET["event_id"]);

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
    <link rel="stylesheet" href="css/events.css">
</head>
<body>
    <?php 
        if ($loggedIn) {
            echo strtr(file_get_contents("defaults/navbar_loggedIn.html"),array('$username' => $data_user["username"]));
        }
        else {
            echo file_get_contents("defaults/navbar_loggedOut.html");
        }
    ?>

    <div class="container">
        <div class="row">
            <div class="col s5">
                <img src="images/icon_a.png" id="event_image" alt="">
            </div>
        </div>
        <div class="row">
            <div class="col s3">
                <h4> <?php echo $data_event["name"] ?> </h4>
            </div>
            <div class="col s5">
                <h5>Ongoing</h5>
            </div>
        </div>
        <div class="row">
            <div class="col s7">
                <ul class="tabs">
                    <li class="tab col s4"><a href="#details" class="tab_item">Details</a></li>
                    <li class="tab col s4"><a class="tab_item" href="#participants">Participants</a></li>
                    <li class="tab col s4"><a href="#manage" class="tab_item">Manage</a></li>
                </ul>
            </div>
        </div>

        <div class="row" id="details">
            <div class="row" id="date_range">
                <div class="col s2" >From</div>
                <div class="col s2" id="from"></div>
                <div class="col s2">To</div>
                <div class="col s2" id="to"></div>
            </div>
        </div>
    </div>
    

    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="scripts/event.js"></script>
    <?php
    if ($loggedIn) {
        echo "<script>".file_get_contents("defaults/navbar_loggedIn.js")."</script>";
    }
    ?>
</body>
</html>