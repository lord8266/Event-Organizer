<?php 
require "server/session_utility.php";
$data_user = check_cookie();
if (!$data_user) {
    header("Location: index.php");
    die();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/frameworks/materialize.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"> -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/create_event.css">
    <title>Organise</title>
</head>

<body>
    <?php 
        echo strtr(file_get_contents("defaults/navbar_loggedIn.html"),array('$username' => $data_user["username"]));
    ?>
    
    <div class="container">
        <div class="row" id="tabs">
            <div class="col s12">
                <ul class="tabs">
                    <li class="tab col s4"><a href="#front" class="active tab_item">Front</a></li>
                    <li class="tab col s4"><a class="tab_item" href="#tal">Timing / Location</a></li>
                    <li class="tab col s4"><a href="#desc" class="tab_item">Description</a></li>
                </ul>
            </div>
        </div>
        <div class="row" id="front">
            <div class="col s12">
                <div class="row">
                    <div class="col s3">
                        <div style="">
                            <img class="profile" id="profile" src="images/default.png">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <input  id="event_name" type="text" class="validate">
                        <label for="event_name">Event Name</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <ul class="collapsible" id="collapsible_front">
                            <li class="active">
                                <div class="collapsible-header"><i class="material-icons">add_a_photo</i>Event Profile Image</div>
                                <div class="collapsible-body">
                                    <div class="row">
                                        <div class="col s6 center-align">
                        
                                            <form action="" id="upload_form">
                                                <input class="waves-effect" name="file" type="file" id="upload_file">
                                            </form> <br>
                                            <button class="btn waves-effect" id="upload_button">Upload Image</button>
                                        </div>
                                      
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div id="tal" class="row ">
            <div class="col s12">
                <ul class="collapsible" id="collapsible_tal">
                    <li class="active" >
                        <div class="collapsible-header"> <i class="material-icons">access_time</i> Choose Start </div>
                        <div class="collapsible-body">
                            <label for="date_start">Start Date</label>
                            <input type="text" class="datepicker" id="date_start">
                            <label for="time_start">Start Time</label>
                            <input type="text" class="timepicker" id="time_start">
                        </div>
                    </li>
                    <li class="active">
                        <div class="collapsible-header"> <i class="material-icons">access_time</i> Choose End </div>
                        <div class="collapsible-body">
                            <p>Choose Time If Applicable</p>
                            
                            <label for="date_end">End Date</label>
                            <input type="text" class="datepicker" id="date_end">
                            <label for="time_end">End Time</label>
                            <input type="text" class="timepicker" id="time_end">
                        </div>
                    </li>
                    <li class="active">
                        <div class="collapsible-header"> <i class="material-icons">add_location</i> Location</div>
                        <div class="collapsible-body">
                            <div class="row">
                                <div class="col s9" id="map">
                                    
                                    <textarea name="" class="materialize-textarea" id="location" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div id="desc" class="row">
            <div class="offset-s1 col s10">

                <p> Enter Description / Any extra details</p>
            </div>
            <div class="col s10 input-field">
                <i class="material-icons prefix"> mode_edit</i>
                <textarea id="description_text" rows="20" class="materialize-textarea">

                </textarea>
            </div>
        </div>

        <div class="row">
            <div class="col s7">
                <p>Add Tags (Max 4)</p>
                <div id="tags">
                    <a class="btn-floating btn-small waves-effect waves-light grey modal-trigger" href="#modal_add_tags" id="add_tag_button">
                        <i class="material-icons">add</i>
                    </a>
                    <div id="modal_add_tags" class="modal">
                        <div class="modal-content">
                            <h4>TagName</h4>
                            <input type="text" id="tag_name">
                        </div>
                        <div class="modal-footer">
                            <a href="#!" class="modal-close waves-effect waves-green btn-flat" id="add_tag">Add</a>
                            <a href="#!" class="modal-close waves-effect waves-green btn-flat" id="cancel_add_tag">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s7">

                <p>
                    <label>
                        <input type="checkbox" id="check_paid" />
                        <span class="black-text">Paid</span>
                    </label>
                    <div class="input-field" id="price_div">
                        <label for="price">
                            Price
                        </label>
                        <input type="number" name="" id="price">
                    </div>
                </p>
                
            </div>
        </div>
        <div class="row">
            <div class="col s8">
                <a href="#" class="btn btn-large waves-effect waves-light" id="create_event"> Create Event!</a>
            </div>
        </div>
    </div>
    </div>


</body>
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="scripts/create_event.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHi4VwG2PbROcaOVYl1xS_kII5BsULIzo&callback=initMap"
    async defer>
    </script>

<?php 
echo '<script src="defaults/navbar_loggedIn.js"></script>';
?>

</html>