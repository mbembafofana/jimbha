<?php 

session_start();
$_SESSION = array();
//Destruction de la session 
session_destroy();

header("Location: index_.php");

?>
