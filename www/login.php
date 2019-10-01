<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="defaults.css">
    <title>Login To Organiser</title>
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
            
        </nav>
    <div class="container-fluid">
       
        <div class="row justify-content-center my-5">
            <div class="col-5 justify-content-center">
            <h2 class="text-center"> Login To Organiser</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-4 rounded aa shadow pt-4">              
                <div class="form-group">
                    <label for="email" class="font-weight-bold">Email</label> <br>
                    <input type="email" class="form-control" id="email" name="email"> 
                </div>
                <div class="form-group">
                    <label for="password" class="font-weight-bold">Password</label> <br>
                    <input type="password" class="form-control" id="password" name="password"> 
                </div>
                <div class="row front pb-3 p-4">
                    <button id="login" class="btn-block btn-dark btn-lg"  value="Login" >Login</button>
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
        <script src="scripts/login.js"></script>
        <style>
        h2 {
            color: rgb(156, 25, 25);
            font-family:cursive;
            font-size: 3em;
        }
        </style>
</body>
</html>