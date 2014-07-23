<?php
require_once("../classes/session.php");
$session = new Session();

if(!$session->is_logedin() || $session->is_client()){
	$session->message(" vous n'etes pas connecté ");
	header("location:../index.php");
}
require_once("../classes/admin.php");
require_once("../classes/service.php");
require_once("../includes/functions.php");

$admin= new Admin();
$admin_data=$admin->find_by_id($session->get_user_id());

if( isset($_POST["nom"]))
{
	$nom=$_POST["nom"];
	$type=$_POST["type"];
	if(empty($nom) || empty($type))
	{
	   header('HTTP/1.1 500 les deux champs sont obligatoire');
	    exit(); 	
	}
	
	$service = new Service();
	$service->set_service("svc_nom",$nom);
	$service->set_service("svc_type",$type);
	
	if(!$service->create())
	{
		header('HTTP/1.1 500 probleme de la BD ressayer');
	    exit(); 
	}
	$data=$service->get_service();
	if(!$admin->est_responsable($data["svc_id"]))
	{
		header('HTTP/1.1 500 probleme de la BD,lien ressayer');
	    exit(); 
	}
	
	echo '<tr id="re_'.escape($data["svc_id"]).'">
		 <td>'.escape($data["svc_nom"]).'</td>
		 <td>'.escape($data["svc_type"]).'</td>
		 <td><button onClick="return delete_service('.escape($data["svc_id"]).');" class="btn btn-default">supprimer</button></td>
		 </tr>';
	
	
	
}else if(isset($_POST["svc_id"]))
{
	if(!$admin->delete_est_responsable($_POST["svc_id"]))
	{
		header('HTTP/1.1 500 , vérifier que tu n\'a pas reclamer aucune réclamation avec ce service');
	    exit();	
	}
	$service= new Service();
	$service->find_by_id($_POST["svc_id"]);
	$service->delete();
	
	echo "deleted";
}else{
	header('HTTP/1.1 500 non post request');
	    exit();
}






?>