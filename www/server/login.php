<?php 

require_once 'dbconfig.php';

function get_data($q,$i) {
    $q->data_seek(0);
    $d = $q->fetch_array();
    return $d[$i];
}

$email = $_POST['email'];
$password = $_POST['password'];
$ret = 0;
$conn = new mysqli($db_host,$db_username,$db_password,$db_name);
if ($conn) {
  
$q= $conn->query("SELECT * FROM users where email='$email'");
if ($q->num_rows==1) {
    $ret = 1;
}

$q= $conn->query("SELECT * FROM users where email='$email' AND password='$password'");
if ($q->num_rows==1) {
    $ret = 2;

    session_start();
    $_SESSION['username'] = get_data($q,0);
    $_SESSION['email'] = get_data($q,1);
    $_SESSION['password'] = get_data($q,2);
}
echo $ret;
}
else {
    
}
?>

