<?php

require_once("../classes/session.php");
$session = new Session();

if(!$session->is_logedin() || $session->is_client()){
	$session->message(" vous n'etes pas connecté ");
	header("location:../index.php");
}
require_once("../classes/admin.php");
require_once("../classes/commentaire.php");
require_once("../includes/functions.php");
if(isset($_GET["cmt_id"])){
$admin= new Admin();
$admin_data=$admin->find_by_id($session->get_user_id());
$commentaire=new Commentaire();
$commentaire->find_by_id($_GET["cmt_id"]);

if($commentaire->delete())
{
	$session->message("le commentaire a été bien supprimer");
	header("location:../admin.php");
}else
{
	$session->message("erreur ressayer ");
	header("location:../admin.php");
}
  }else
  {
	echo "no get request";  
  }






?>