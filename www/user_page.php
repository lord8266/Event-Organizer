<?php session_start();
if (!isset($_SESSION['id'])) {
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
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
   <link rel="stylesheet" href="css/user_page.css">
   <link rel="stylesheet" href="css/navbar.css">
   <title>Organise</title>
</head>

<body>
   <nav>
      <div class="nav-wrapper">
         <a href="#" class="logo">Organizer</a> </li>
         <ul class="right">
            <li> <a href="">Events</a></li>
            <li><a href="">About</a></li>
            <li>
               <a class='dropdown-trigger' href='#' data-target='dropdown1'><?php echo $_SESSION['username'] ?></a>
               <ul id='dropdown1' class='dropdown-content'>
                  <li><a href="create_event.php">Create Event</a></li>
                  <li class="divider"> </li>
                  <li><a id="logout">Logout</a></li>
               </ul>
            </li>
         </ul>
      </div>
   </nav>
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
      <div class="divider"></div>
   </div>

</body>
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
   $('.dropdown-trigger').dropdown();
   $('#logout').click(() => {
      $.post('server/api_layer.php', {
         kind: "logout"
      }, (data, status) => {
         window.location.href = "index.php"
      });
   })
</script>

</html>