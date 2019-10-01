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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="defaults.css">
    <link rel="stylesheet" href="user_page.css">
    <title>Organise</title>
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
                <button class="btn btn-dark" id="logout"> Logout</button>
            </li>
            <li class="nav-item">
                <a class="text-dark nav-link" href=""> <?php echo $_SESSION['username'] ?> </a>
            </li>
        </ul>
    </nav>

    <div class="container-fluid"> 
        <div class="row ml-5">
            <div class="col-1 tab-menu">
                <div class="nav-item p-5 tab-item">
                    <a class="" href="">
                        <strong class="text-dark">Find Events</strong>
                    </a>
                </div>
                <div class="nav-item p-5 tab-item">
                <a href="">
                        <strong class="text-dark">Your Events</strong>
                    </a>
                </div>
                <div class="nav-item p-5 tab-item">
                <a href="">
                        <strong class="text-dark">Edit Profile</strong>
                    </a>
                </div>
                <div class="nav-item p-5 tab-item">
                <a href="">
                        <strong class="text-dark">Logout</strong>
                    </a>
                </div>
            </div>
            <div class="col-9">
                  
                <nav class="navbar navbar-expand-lg navbar-default" >
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                    <button class="btn">New Event</button>
                    </li>
                </ul>
                </nav>
            <div class="content p-4">
                <h4 class="text-center">content</h4>
            </div>
        </div>
        <div>
             
        </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        $('#logout').click(()=> {
            $.post('server/api_layer.php',{kind:"logout"},(data,status) => {
                window.location.href = "index.php"
            });
            
        })
    </script>
</body>
</html>