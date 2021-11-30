<?php

 ini_set('session.save_path', 'session');
session_start();
session_destroy();
  header("Location:http://apajuris.in/work/index.php");
    
die();
?>