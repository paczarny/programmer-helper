<?php
ob_start();
session_start();
require_once('../Model/class.user.php');

define('DBHOST','localhost');
define('DBUSER','root');
define('DBPASS','');
define('DBNAME','paidb');

$db = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPASS);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$user = new User($db); 
?>