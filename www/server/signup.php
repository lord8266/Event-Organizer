<?php

    try {
    require_once 'dbconfig.php';
    
    $conn = mysqli_connect($db_host,$db_username,$db_password,$db_name);
    if ($conn) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $q = "INSERT INTO users(username,email,password) VALUES ('$username','$email','$password')";
        if (mysqli_query($conn,$q)) {
            echo "SUCCESS";
        }
        else{
            echo "NO";
        }
    }
    else {
    echo "GG";
    }
}
catch( Exception $e) {
    echo("aaa");
}
?>