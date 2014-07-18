<?php
require_once("../classes/session.php");
$session = new Session();

if($session->is_logedin() ){
	
	$session->logout();
	$session->message(" vous etes deconnecté ");
 header("location:../index.html");
}
?>