<?php 
require 'server/session_utility.php';
$data_user = check_cookie();
if ($data_user) {
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
    <link rel="stylesheet" href="css/frameworks/materialize.css"/>
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/login.css">
    <title>Login To Organiser</title>
</head>
<body>
    <?php 
    echo file_get_contents("defaults/navbar_loggedOut.html");
    ?>
    <div class="container ">
        <div class="row login_form">
            <div class="offset-s4 col s6">
            
                <div class="row">
                    <div class="col-5">
                    <h2 class="text-center"> Login To Organiser</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col s10 align-center">              
                        <div class="form-group">
                            <label for="email" class="font-weight-bold">Email</label> <br>
                            <input type="email" class="form-control" id="email" name="email"> 
                        </div>
                        <div class="form-group">
                            <label for="password" class="font-weight-bold">Password</label> <br>
                            <input type="password" class="form-control" id="password" name="password"> 
                        </div>
                    </div>
                </div>
                <div class="row front">
                    <div class="col s4">
                        <a id="login" class="waves waves-effect btn"  value="Login" >Login</a>
                    </div>
                </div>
            </div>
        </div>
            
    </div>
    
       
        <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
        <script src="scripts/login.js"></script>
        
</body>
</html>