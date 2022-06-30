<?php
session_start();


session_unset();
session_destroy();
//! sent user to index.php attaching "userid" as I used get global variable in index.php line 113 just to avoid warning/error;
header("location: /secret/index.php/?userid=");
?>