<?php
require_once("../classes/session.php");
$session = new Session();

if(!$session->is_logedin()){
	$session->message(" vous n'etes pas connecté ");
	header('HTTP/1.1 500  tu dois être connecté');
	    exit();
}
require_once("../classes/client.php");
require_once("../classes/admin.php");
require_once("../classes/service.php");
require_once("../includes/functions.php");


	if(isset($_POST) && $session->is_client())
	{
		$client= new Client();
$client_data=$client->find_by_id($session->get_user_id());
		$nom=trim($_POST["nom"]);
		$prenom=trim($_POST["prenom"]);
		$email=trim($_POST["email"]);
		$password=trim($_POST["password"]);
		
		if(empty($nom) || empty($prenom) || empty($email) || empty($password) || empty($_POST["password2"]) )
		{
			header('HTTP/1.1 500  tous les champs sont  obligatoire sauf adresse tel');
			exit();
		}
		if (!preg_match("#^[A-Za-z0-9._-]+@[A-Za-z0-9._-]{2,}\.[A-Za-z]{2,4}$#", $email)) {
		header('HTTP/1.1 500  L\'adresse ' . $email . ' n\'est pas valide');
	    exit();
	}
	if(strlen($password)<6)
	{
		header('HTTP/1.1 500 '.escape(' le mot de pass doit être composer au moins de 6 caractères'));
	    exit();
	}
	if($password!=trim($_POST["password2"]))
	{
		header('HTTP/1.1 500 '.escape(' la confirmation de mot de pass est erronée'));
	    exit();
	}
	
	$client->set_utilisateur("nom",$nom);
	$client->set_utilisateur("prenom",$prenom);
	$client->set_utilisateur("email",$email);
	$client->set_utilisateur("password",$password);
	$client->set_utilisateur("adresse",$_POST["adresse"]);
	$client->set_utilisateur("num_tel",$_POST["tel"]);
	if(!$client->update()){
		header('HTTP/1.1 500 '.escape(' erreur de la BD'));
	    exit();
	}
	
	echo "Les nouvelles modifications ont été bien enregistré";
	
}else if(isset($_POST) && !$session->is_client())
	{
		$admin = new Admin();
		$admin->find_by_id($session->get_user_id());
		$nom=trim($_POST["nom"]);
		$prenom=trim($_POST["prenom"]);
		$email=trim($_POST["email"]);
		$password=trim($_POST["password"]);
		
		if(empty($nom) || empty($prenom) || empty($email) || empty($password) || empty($_POST["password2"]) )
		{
			header('HTTP/1.1 500  tous les champs sont  obligatoire sauf adresse tel');
			exit();
		}
		if (!preg_match("#^[A-Za-z0-9._-]+@[A-Za-z0-9._-]{2,}\.[A-Za-z]{2,4}$#", $email)) {
		header('HTTP/1.1 500  L\'adresse ' . $email . ' n\'est pas valide');
	    exit();
	}
	if(strlen($password)<6)
	{
		header('HTTP/1.1 500 '.escape(' le mot de pass doit être composer au moins de 6 caractères'));
	    exit();
	}
	if($password!=trim($_POST["password2"]))
	{
		header('HTTP/1.1 500 '.escape(' la confirmation de mot de pass est erronée'));
	    exit();
	}
	
	$admin->set_utilisateur("nom",$nom);
	$admin->set_utilisateur("prenom",$prenom);
	$admin->set_utilisateur("email",$email);
	$admin->set_utilisateur("password",$password);
	$admin->set_utilisateur("adresse",$_POST["adresse"]);
	$admin->set_utilisateur("num_tel",$_POST["tel"]);
	if(!$admin->update()){
		header('HTTP/1.1 500 '.escape(' erreur de la BD'));
	    exit();
	}
	
	echo "Les nouvelles modifications ont été bien enregistré";
	
}else
{
	header('HTTP/1.1 500 , no post request');
	    exit();
}


?>