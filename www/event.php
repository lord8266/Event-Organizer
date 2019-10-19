<?php
require 'server/database_utility.php';
require 'server/session_utility.php';

$data_user= check_cookie();
$loggedIn = $data_user!=NULL;
$data_event = get_event_details($_GET["event_id"]);
if (!$data_event) {
    header("Location: index.php");
    die();
}
if ($data_user) {
    $isOwner = $data_event["owner"]==$data_user["id"];
}
else {
    $isOwner = FALSE;
}
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
                <img src="images/default.png" id="event_image" alt="">
            </div>
        </div>
        <div class="row">
            <div class="col s3">
                <h5 > <?php echo $data_event["name"] ?> </h5>
            </div>
            <div class="col s4" id="verified">

            </div>
        </div>
        <div class="row">
            <div class="col s7">
                <ul class="tabs">
                    <li class="tab col s4"><a href="#details" class="tab_item">Details</a></li>
                    <li class="tab col s4"><a class="tab_item" href="#participants_tab">Participants</a></li>
                    <?php if ($isOwner) {
                    echo '<li class="tab col s4"><a href="#manage" class="tab_item">Manage</a></li>';
                    }?>
                </ul>
            </div>
        </div>
        <div id="details">
            <div class="row">
                <div class="row">
                    <div class="col s1">
                        <strong>Owner</strong>
                    </div>
                    <div class="col s2">
                        <a  class="black-text" href="user.php?user_id=<?php echo $data_user["id"]?>"> <?php 
                        if ($data_user["id"]==$data_event["owner"]) {
                            echo "You";
                        }
                        else
                        {
                            echo $data_event["owner_name"];
                        }
                        ?>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row" id="date_range">
                <div class="col s4">
                    <table>
                        <tr>
                            <th> From</th><th>To</th> <th>Status</th>
                        </tr>
                        <tr>
                            <td id="from"></td><td id="to"></td> <td id="status"> Ongoing</td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <div class="row">
                <div class="col s2"> <h5> Location </h5> </div>
            </div>
            <div class="row">
                <div class="col s5" id="location"> </div>
            </div>
            <div class="row">
                <div class="col s3"> <h5>Tags</h5> </div>
            </div>
            <div class="row">
                <div class="col s4" id="tags">  </div>
            </div>
            <div class="row">
                <div class="col s4"> <h5> Additional Details </h5> </div>
            </div>
            <div class="row">
                <div class="col s4" >
                    <p id="description"> </p>
                </div>
            </div>
            <div class="row">
                <div class="col s4" id="price">
                </div>
            </div>
            <div class="row"><div class="col s5"> <a class="btn btn-large waves waves-effect" id="request" >  </a> </div></div>';
            
        </div>

        <div id="participants_tab">
            <div class="row">
                <div class="col s4" id="participants">
                    
                        
                </div>
            </div>
        </div>
        <?php 
            if ($isOwner) {
                echo file_get_contents("defaults/manage.html");
            }
        ?>
    </div>
    

    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="scripts/event.js"></script>
    <?php
    if ($loggedIn) {
        echo '<script src="defaults/navbar_loggedIn.js"></script>';
    }
    if ($isOwner) {
        echo '<script src="defaults/manage.js"></script>';
    }
    ?>
</body>
</html>