<?php 
require_once "server/session_utility.php";
if (check_cookie()) { 
	header("Location: search_page.php");
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="X-UA-Compatible" content="ie=edge" />
		<link rel="stylesheet" href="css/frameworks/materialize.css"/>
		<link rel="stylesheet" href="css/navbar.css">
		<link rel="stylesheet" href="css/index.css">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<title>Document</title>
	</head>
	<body>
		<?php
			echo file_get_contents("defaults/navbar_loggedOut.html")
		?>
		<div class="container">
			<div class="row search">
				<div class="  col s9">
					<i class="" aria-hidden="true"></i>
					<input class="" type="text">
				</div>
				<div class="offset-s1 col s2">
					<a href="" id="search" class="btn waves waves-effect"> <i class="material-icons left">search</i> Search Events</a>
				</div>
			</div>	
		
			<div class="row pane">
				<div class="col s6 desc_pane">
					<table>
						<th class="display-3">For G</th>
					</table>
				</div>
			
				<div class="offset-s1 col s5 signup_pane">
					<div class="row">
						<div class="col s10 input-field">
							<label for="username" class="">Username</label> <br>
							<input type="text" class="" id="username" name="username"> 
						</div>	
					</div>
					<div class="row">
						<div class="col s10 input-field">
							<label for="email" class="font-weight-bold">Email</label> <br>
							<input type="email" class="form-control" id="email" name="email"> 
						</div>	
					</div>
					<div class="row">
						<div class="col s10 input-field">
							<label for="password" class="">Password</label> <br>
							<input type="password" class="" id="password" name="password">
						</div>	
					</div>
					<div class="row">
						<div class="col s10">
							<a id="signup" class="btn btn-large waves waves-effect"value="Sign Up" >Sign Up</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
		<script src="scripts/signup.js"></script>
	</body>
</html>
