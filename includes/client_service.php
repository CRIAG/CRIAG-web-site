<?php
require_once("../classes/session.php");
$session = new Session();

if(!$session->is_logedin() || !$session->is_client()){
	$session->message(" vous n'etes pas connecté ");
	header("location:../index.html");
}
require_once("../classes/client.php");
require_once("../classes/service.php");
require_once("../includes/functions.php");

$client= new Client();
$client_data=$client->find_by_id($session->get_user_id());

if( isset($_POST["service"]))
{

	if (empty($_POST['service']) || !is_numeric($_POST['service'])) {
     
	header('HTTP/1.1 500 , le champ est obligatoire');
	    exit();
		
    }
	
	if(!$client->beneficier($_POST['service']))
	{
		header('HTTP/1.1 500 , probleme de la BD ressayer');
	    exit();
	}
	$service= new Service();
	$data=$service->find_by_id($_POST['service']);
	
	echo '<tr id="re_'.escape($data["svc_id"]).'">
		 <td>'.escape($data["svc_nom"]).'</td>
		 <td>'.escape($data["svc_type"]).'</td>
		 <td><button onClick="return delete_service('.escape($data["svc_id"]).');" class="btn btn-default">supprimer</button></td>
		 </tr>';
	
	
}else if(isset($_POST["rec_id"]))
{
	if(!$client->delete_beneficier($_POST["rec_id"]))
	{
		header('HTTP/1.1 500 , vérifier que tu n\'a pas reclamer aucune réclamation avec ce service');
	    exit();	
	}
	echo "deleted";
}else
{
header('HTTP/1.1 500 , there is no post request');
	    exit();	
}


?>