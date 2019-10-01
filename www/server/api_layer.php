<?php 
   require_once 'database_utility.php';
   require_once 'session_utility.php';
   if ($_POST['kind']=='signup') {
      $conn = connect();
      if (email_exists($conn,$_POST['email'])) {
         echo 0;
      }
      else {
      $id =newuser($conn,$_POST['username'],$_POST['email'],$_POST['password']);
      set_session(datafrom_id($conn,$id));
      echo 1;
      }
      }
   else if ($_POST['kind']=='login') {
      $conn = connect();
      $ret = 0;
      if (email_exists($conn,$_POST['email'])) {
         $ret = 1;
      }
      $s = check_login($conn,$_POST['email'],$_POST['password']);
      if ($s) {
         set_session(datafrom_email($conn,$_POST['email']));
         $ret = 2;
      }
      echo $ret;
   }
   else if ($_POST['kind']=='email') {
      $conn = connect();
      echo email_exists($conn,$_POST['email']);
   }
   else if ($_POST['kind']=='logout') {
      session_start();
      setcookie("id", "", time()-3600,"/");
      unset($_SESSION['id']);
      session_destroy(); //temporary
      echo 1;
   }

?>