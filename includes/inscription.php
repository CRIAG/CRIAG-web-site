<?php
require_once("../classes/session.php");
require_once("functions.php");
$session = new Session();	


	require_once(__DIR__.'/../classes/client.php');
	//require_once(__DIR__.'functions.php');
	


if(!isset($_POST)) { header("location:../index.html"); }

$nom= trim($_POST["nom"]);
$prenom= trim($_POST["prenom"]);
$email= trim($_POST["email"]);
$password= trim($_POST["password"]);

if(empty($nom) || empty($prenom) ||empty($email)|| empty($password) ){
	
  $session->message('Tous les champs avec * sont obligatoires.');
	      header('Location: ../formulaire.php');
	
	
	}


 	

	
	 
	if(!$session->is_there_any_msg()) {
	  if (user_exists($_POST['email'])) {
	    $session->message('Nous sommes désolés,  l\'adresse email: ' . $_POST['email'] . ' est déjà utilisée par un autre utilisateur');
	    $valid = false;
	    header('Location: ../formulaire.php');
	  }

	  if (!preg_match("#^[A-Za-z0-9._-]+@[A-Za-z0-9._-]{2,}\.[A-Za-z]{2,4}$#", $_POST['email'])) {
	    $session->message('L\'adresse ' . $_POST['email'] . ' n\'est pas valide');
	    $valid = false;
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
	}

/*

  	if ($valid) {				
		$emailcode = md5($_POST['email'] + microtime());
		$emailcode = substr($emailcode, -13, 7);
		if ($_POST['utilisateur'] == 'Etudiant') {
			$register_data = array(
				'e_nom' => ucfirst($_POST['nom']),
				'e_email' => $_POST['email'],
				'e_prenom' => ucfirst($_POST['prenom']),
				'e_password' => $_POST['password'],
				'e_validation' => 0,
			);
		} else {
			$register_data = array(
				'pf_nom' => ucfirst($_POST['nom']),
				'pf_email' => $_POST['email'],
				'pf_prenom' => ucfirst($_POST['prenom']),
				'pf_password' => $_POST['password'],
				'pf_validation' => 0,
			);
		}
		$_SESSION['utilisateur'] = $_POST['utilisateur'];
		$_SESSION['data'] = $register_data;
		$_SESSION['code'] = $emailcode;
		register_user($register_data,$emailcode);
	    header('Location: ../activation.php');
	}		
?>*/