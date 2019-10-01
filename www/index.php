<?php 
require_once "server/session_utility.php";
session_start();
if (check_cookie()) { 
	header("Location: user_page.php");
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="X-UA-Compatible" content="ie=edge" />
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"/>
		<link rel="stylesheet" href="defaults.css">
		<title>Document</title>
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-default ">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a href="index.php" class="navbar-item"> 
					<table class="">
						<tr> <td><img src="images/icon_a.png" class="navbar-brand logo" alt=""></td>
							<td><span href="" class="navbar-brand text-dark">Organiser</span></td>
						</tr>
					</table>
				</a>	
				</li>
				<li class="nav-item">
					<a class="nav-link text-dark" href="#">Events</a>
				</li>
				<li class="nav-item">
					<a class="nav-link text-dark" href="#">About</a>
				</li>
			</ul>
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a href="login.php" class="nav-link text-dark">Login</a>
				</li>
				
			</ul>
		</nav>
		<div class="container-fluid">
			<div class="row ">
				<div class="ml-3 col-7">
					<i class="fas fa-search" aria-hidden="true"></i>
					<input class="form-control shadow" type="text">
				</div>
				
				<div class="col-4 search">
					<button class="btn btn-primary btn-block shadow"> Search</button>
				</div>		
			</div>
		</div>
		<div class="container-fluid justify-content-center">
	
			<div class="row rounded">
				<div class="col-7 rounded front aa shadow p-4">
					<table>
						<th class="display-3">For G</th>
					</table>
				</div>
				<div class="col-1"></div>
				<div class="col-3 rounded aa shadow pt-4">
					
					<div class="form-group">
						<label for="username" class="font-weight-bold">Username</label> <br>
						<input type="name" class="form-control" id="username" name="username"> 
					</div>
					<div class="form-group">
						<label for="email" class="font-weight-bold">Email</label> <br>
						<input type="email" class="form-control" id="email" name="email"> 
					</div>
					<div class="form-group">
						<label for="password" class="font-weight-bold">Password</label> <br>
						<input type="password" class="form-control" id="password" name="password"> 
					</div>
					<div class="row front pb-3 p-4">
						<button id="signup" class="btn-block btn-dark btn-lg"  value="Sign Up" >Sign Up</button>
					</div>
					
				
					

				</div>
				
			</div>
		</div>
		<div class="toast p-2" role="alert" style="position: absolute;top: 0;right: 0;">
			<table class="toast-body text-danger font-weight-bold "></table>
		</div>
		
		<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		<script src="scripts/signup.js"></script>
	</body>
</html>