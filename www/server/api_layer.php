<?php 
   require_once 'database_utility.php';
   require_once 'session_utility.php';
   if ($_SERVER["CONTENT_TYPE"]=="application/json") {
         $data = file_get_contents("php://input");
         echo $data;
         $data = json_decode($data);
         $conn = connect();
         return new_event($conn,$data);
   }
   else {
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
      else if ($_POST['kind']=='event_details') {
         
         $data_event = get_event_details($_COOKIE["event_id"]);
         
         echo json_encode($data_event);
      }
      
}

?>