<?php
   require 'dbconfig.php';
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
?>