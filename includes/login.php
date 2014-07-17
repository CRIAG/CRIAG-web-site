<?php
require_once("../classes/client.php");
require_once("../classes/admin.php");
require_once("../classes/session.php");
$session =  new Session();
if (!empty($_POST)) {
    	$email = trim($_POST['email']);
    	$pass = trim($_POST['password']);
		
 if (empty($_POST['email']) || empty($_POST['password'])) {
    
	header('HTTP/1.1 500 Error occurred, Veuillez entrer votre adresse électronique et votre mot de passe');
	    exit();
		
    }
	
	$client = new Client();
	$admin = new Admin();
	
	$login1= $client->authenticate($email,$pass);
	$login2= $admin->authenticate($email,$pass);
	
	if (!$login1 && !$login2) {
    		header('HTTP/1.1 500 Error occurred, la combinaison adresse électronique/mot de passe n\'est pas valide');
			exit();
    	} else {
			if($login1)
			{
                $data=$client->get_utilisateur();
				$session->login($data["u_id"],true);
				echo "client";
			} else {
				$data=$admin->get_utilisateur();
				$session->login($data["u_id"],false);

				echo "admin";
			}
		
		}
}




?>