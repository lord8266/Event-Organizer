<?php
   require 'dbconfig.php';
   session_start();
   function connect()  {
      global $db_username,$db_password,$db_host,$db_name;
      $conn = new mysqli($db_host,$db_username,$db_password,$db_name);
      return $conn;
   }

   function uid($conn) {
      $q = $conn->query("SELECT id from users");
      $new_id = md5(uniqid());
      while ($conn->query("SELECT id from users where id='$new_id'")->num_rows!=0 ) {
         $new_id = md5(uniqid());
      }
      return $new_id;
   }
   
   
   function newuser($conn,$username,$email,$password) {
      $id = uid($conn);
      $q= $conn->prepare("INSERT INTO users(id,username,email,password) VALUES(?,?,?,?)");
      $q->bind_param("ssss",$id,$username,$email,$password);
      $q->execute();
      
      return $id;
   }

   function email_exists($conn,$email) {
      $q = $conn->prepare("SELECT * FROM users where email=?");
      $q->bind_param("s",$email);
      $q->execute();
      return $q->get_result()->num_rows!=0;
   }

   function check_login($conn,$email,$password) {
      $q = $conn->prepare('SELECT * FROM users where email=? AND password=?');
      $q->bind_param("ss",$email,$password);
      $q->execute();
      return $q->get_result()->num_rows!=0;
   }

   function datafrom_id($conn,$id) {
      $q = $conn->prepare('SELECT * FROM users where id=?');
      $q->bind_param("s",$id);
      $q->execute();
      $res = $q->get_result();
      if ($res->num_rows==0) {
         return 0;
      }
      else {
         return $res->fetch_assoc();
      }
   }

   function datafrom_email($conn,$email) {
      $q = $conn->prepare('SELECT * FROM users where email=?');
      $q->bind_param("s",$email);
      $q->execute();
      $res = $q->get_result();
      if ($res->num_rows==0) {
         return 0;
      }
      else {
         return $res->fetch_assoc();
      }
   }

   function event_id($conn) {
      $q = $conn->query("SELECT id from events");
      $new_id = md5(uniqid());
      while ($conn->query("SELECT id from events where id='$new_id'")->num_rows!=0 ) {
         $new_id = md5(uniqid());
      }
      return $new_id;
   }

   function new_event($conn,$data) {
      $id = event_id($conn);
      try {
         $conn->begin_transaction();
         $q = $conn->prepare("INSERT INTO events(id,name,start,end,paid,price,tags,description,owner) VALUES(?,?,?,?,?,?,?,?,?)");
         $q->bind_param("ssssiisss",$id,$data->name,$data->start,$data->end,$data->paid,$data->price,$data->tags,$data->description,$_SESSION["id"]);
         $q->execute();
         $q = $conn->prepare("INSERT INTO participants(event_id,user_id,access) VALUES(?,?,2)");
         $q->bind_param("ss",$id,$_SESSION["id"]);
         $q->execute();
         $conn->commit();
         return $id;
      }
      catch (Exception $e) {
         $conn->rollback();
         return NULL;
      }
   }
   function get_event_details($id) {
      $conn = connect();
      $q = $conn->prepare("SELECT * FROM events WHERE id=?");
      $q->bind_param("s",$id);
      $q->execute();
      $res = $q->get_result();
      if ($res) {
         return $res->fetch_assoc();
      }
      else {
         return NULL;
      }
   }

   function get_event_participants($id,$access) {
      $conn = connect();

      try {
         $q = $conn->prepare("SELECT participants.user_id,users.username from participants INNER JOIN users on participants.user_id=users.id where participants.access=? and participants.event_id=?");
         $q->bind_param("is",$access,$id);
         $q->execute();
         $res = $q->get_result();
         return json_encode($res->fetch_all(MYSQLI_ASSOC));
      }
      catch (Exception $e) {
         return NULL;
      }
   }

?>