<?php
require_once("../classes/session.php");
$session = new Session();

if(!$session->is_logedin() || !$session->is_client()){
	$session->message(" vous n'etes pas connecté ");
	header("location:../index.php");
}
require_once("../classes/client.php");
require_once("../classes/reclamation.php");
require_once("../includes/functions.php");
if(isset($_GET["re_id"])){
$client= new Client();
$client_data=$client->find_by_id($session->get_user_id());
$reclamation=new Reclamation();
$reclamation->find_by_id($_GET["re_id"]);

if($reclamation->delete($session->get_user_id()))
{
	$session->message("la reclamation a été bien supprimer");
	header("location:../client.php");
}else
{
	$session->message("erreur ressayer ");
	header("location:../client.php");
}
  }else
  {
	echo "no get request";  
  }


?>