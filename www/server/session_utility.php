<?php 
   require_once 'database_utility.php';
   function set_session($data,$conn=NULL) {
      $_SESSION['id'] = $data['id'];
      $_SESSION['username'] = $data['username'];
      setcookie("id",$data['id'],time()+31536000,'/');
   }

   function check_cookie() {
      $conn = connect();
      if (isset($_COOKIE["id"])) {
         $q = datafrom_id($conn,$_COOKIE["id"]);
         if ($q) {
            set_session($q);
            return $q;
         }
      }
      return NULL;
   }
?>