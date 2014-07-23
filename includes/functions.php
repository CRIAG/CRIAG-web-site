<?php

function escape($var)
{
	return htmlEntities($var, ENT_QUOTES);
}

function reduce_name($name)
{
	$length=strlen($name);
	if($length<=10) return $name;
	
	return substr($name,0,7)."..";	
}

 function user_exists($username)
	{
	    global $db;
		$sql = 'SELECT u_id FROM utilisateur inner join client on utilisateur.u_id=client.utilisateur_u_id WHERE utilisateur.email = :email';
		$re=$db->query($sql,array("email"=>$username));
		$resultat=$re->fetch();

		$sql = 'SELECT u_id FROM utilisateur inner join admin on utilisateur.u_id=admin.utilisateur_u_id  WHERE utilisateur.email = ?';
		$re=$db->query($sql,array($username));
		$resultat2=$re->fetch(PDO::FETCH_ASSOC);
		if (empty($resultat) && empty($resultat2)) {
			return false;
		} else {
			
			return true;
		}
	}

?>