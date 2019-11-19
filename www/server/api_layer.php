<?php 
   require_once 'database_utility.php';
   require 'file_handle.php';
   require_once 'session_utility.php';
   if ($_SERVER["CONTENT_TYPE"]=="application/json") {
         
         check_cookie();
         $data = file_get_contents("php://input");
         $data = json_decode($data);
         $conn = connect();
         $res =  new_event($conn,$data);
         if ($res) {
            http_response_code(200);
            echo $res;
         }
         else {
            http_response_code(503);
            die();
         }
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
         unset_all();
      }
      else if ($_POST['kind']=='event_details') {
         
         $data_event = get_event_details($_COOKIE["event_id"]);
         if ($data_event) {
            echo json_encode($data_event);
         }
         else {
            http_response_code(503);
            die();
         }
      }
      else if ($_POST["kind"]=="participants") {
   
         $res = get_event_participants($_COOKIE["event_id"],1);
         if ($res) {
            echo $res;
         }
         else {
            http_response_code(503);
            die();
         }
      }
      else if ($_POST["kind"]=="pending_requests") {
         
         $res = get_event_participants($_COOKIE["event_id"],0);
         if ($res) {
            echo $res;
         }
         else {
            http_response_code(503);
            die();
         }
      }
      else if ($_POST["kind"]=="check_join") {
         check_cookie();
         $res = access_level($_COOKIE["event_id"],$_COOKIE["id"]);
         echo $res;
      }

      else if ($_POST["kind"]=="request_join") {
         check_cookie();
         $res = access_level($_COOKIE["event_id"],$_COOKIE["id"]);
         if ($res==-1) {
            echo add_request($_COOKIE["event_id"],$_COOKIE["id"]);
         }
         else {
            http_response_code(503);
            die();
         }
      }
      else if ($_POST["kind"]=="all_events") {
         $res = all_events();
         if ($res) {
            echo json_encode($res);
         }
         else {
            echo "[]";
         }
      }
      else if ($_POST["kind"]=="accept_request") {
         $id = $_POST["id"];
         if(check_cookie()) {
            $res = access_level($_COOKIE["event_id"],$id);
            if ($res==0) {
               if(accept_request($_COOKIE["event_id"],$id)) {
                  
               }
            }
            
         }
         else {
            http_response_code(403);
            die();
         }
      }
      else if ($_POST["kind"]=="decline_request") {
         $id = $_POST["id"];
         if(check_cookie()) {
            $res = access_level($_COOKIE["event_id"],$id);
            if ($res==0) {
               if(decline_request($_COOKIE["event_id"],$id)) {
                  
               }
            }
            
         }
         else {
            http_response_code(403);
            die();
         }
      }
      else if ($_POST["kind"]=="file_temp") {
         echo temp_file("aaa");
      }

      else {
         http_response_code(503);
         die();
      }
      
}

?>