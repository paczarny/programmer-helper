<?php
//include config
include_once '../Config/config.php'; 

//log user out
$user->logout();
header('Location: index.php'); 

?>