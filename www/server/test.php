<?php
require_once 'dbconfig.php';


$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die('Connection Failed: '.$conn->connect_error);
}
echo 'Connected .GG $dbname';

$q = "USE logins";
$i =  mysqli_query($conn,$q);
if( $i ) {
    echo "aa$i";
}
else {
    echo "HMM";
}
mysqli_close($conn); 
?>

