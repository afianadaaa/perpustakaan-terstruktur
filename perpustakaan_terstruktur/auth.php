<?php

if(session_id() == '') {
  session_start();
}
if(empty($_SESSION["user_id"]) || empty($_SESSION["user_nama"])){
  header("Location: login.php"); 
  // echo "<pre>";
  // var_dump($_SESSION["user_nama"]);
  // echo "</pre>";
}

?>