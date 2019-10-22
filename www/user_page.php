<?php
require 'server/database_utility.php';
require 'server/session_utility.php';

$data_user= check_cookie();
$loggedIn = $data_user!=NULL;
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" href="css/frameworks/materialize.css">
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
   <link rel="stylesheet" href="css/user_page.css">
   <link rel="stylesheet" href="css/navbar.css">
   <title>Organise</title>
</head>

<body>
   <?php
   if ($loggedIn) {
      echo strtr(file_get_contents("defaults/navbar_loggedIn.html"),array('$username'=> $data_user["username"] ));
   }
   else {
      if ($loggedIn) {
         echo file_get_contents("defaults/navbar_loggedOut.html");
      }
   }
   ?>
   <div class="container">
      <div class="row" id="search">
         <div class="col s10"> <input type="text" id="search_text"></div>
         <div class="col s2"> 
            <a class="waves-effect waves-light btn" id="search_button"><i class="material-icons left">search</i>Search Events</a>
         </div>
      </div>
      <br>
      
      <br>
      <div class="row">
         <div class="col s12">
            <h4> A-Z</h4>
         </div>
      </div>
      <div class="row">
         <div class="col s12" id="events">
            <?php 
               $res  =all_events();
               foreach($res as $e) {
                  echo strtr(file_get_contents("defaults/event_preview.html"),array('$event_name' => $e["name"],'$id' => $e["id"] ));
               }

               
            

            ?>
         </div>
      </div>
   
   </div>

</body>
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="scripts/user_page.js"></script>
<?php 
   if ($loggedIn) {
      echo '<script src="defaults/navbar_loggedIn.js"></script>';
   }
?>
</html>