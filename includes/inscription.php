<?php
require_once("../classes/session.php");
require_once("functions.php");
$session = new Session();	
	if($session->is_logedin() && $session->is_client())
	{
	      header('Location: ../client.php');
	}

	require_once('../classes/client.php');
	require_once('../classes/admin.php');
	require_once("../includes/lib/password.php");
		
	
	
	if(!isset($_POST)) { header("location:../index.php"); }
	
	$nom= trim($_POST["nom"]);
	$prenom= trim($_POST["prenom"]);
	$email= trim($_POST["email"]);
	$password= trim($_POST["password"]);

if(empty($nom) || empty($prenom) ||empty($email)|| empty($password) ){
	
  $session->message('Tous les champs avec * sont obligatoires.');
	      header('Location: ../formulaire.php');
	
	
	}

	if(user_exists("ejjk1@gmail.com"))
	{
		 $session->message( "Email déjà utilisé");
		header('Location: ../formulaire.php');
	}


 	if (!preg_match("#^[A-Za-z0-9._-]+@[A-Za-z0-9._-]{2,}\.[A-Za-z]{2,4}$#", $email)) {
	    $session->message('L\'adresse ' . $email . ' n\'est pas valide');
	    header('Location: ../formulaire.php');
	  }

      if (strlen($_POST['password']) < 6) {
	    $session->message('Le mot de passe doit être de 6 caractères ou plus');
	   header('Location: ../formulaire.php');
	  }

	  if ($_POST['password'] !== $_POST['password2']) {
	    $session->message('Les mots de passe saisis ne sont pas identiques');
	   
	    header('Location: ../formulaire.php');
	  }
	if($session->is_logedin() && !$session->is_client())
	$utilisateur=new Admin();
	else
	$utilisateur = new Client();
	
	
	$utilisateur->set_utilisateur("nom",$nom);
	$utilisateur->set_utilisateur("prenom",$prenom);
	$utilisateur->set_utilisateur("email",$email);
	$utilisateur->set_utilisateur("password",password_hash($password, PASSWORD_BCRYPT));
	$utilisateur->set_utilisateur("adresse",$_POST["adresse"]);
	$utilisateur->set_utilisateur("num_tel",$_POST["tel"]);
	
	
	if(!$utilisateur->create())
	{
		 $session->message('Erreur lors de la creation ,ressayer');
	    header('Location: ../formulaire.php');
	}
	if($session->is_logedin() && !$session->is_client()){
		$session->message('le compte est créé');
	    header('Location: ../admin.php');
	}
	
	
		
		$data=$utilisateur->get_utilisateur();
	    $session->login($data["u_id"],true);
	    header('Location: ../client.php');
	
	
?>