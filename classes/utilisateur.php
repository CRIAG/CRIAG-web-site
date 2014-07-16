<?php 
require_once("database.php");

 abstract class utilisateur { 
private static $_table = "utilisateur";
		protected $utilisateur;
		
		public function __construct()
		{
			$this->utilisateur = array(
										"u_id"=>null,
										"nom"=>null,
										"prenom"=>null,
										"email"=>null,
										"password"=>null,
										"adresse"=>null,
										"num_tel"=>null
									);
		}
		
		
		public function set_utilisateur($key, $value)
		{
			$this->utilisateur[$key] = $value;
		}
		
		public function get_utilisateur()
		{
			return $this->utilisateur;
		}
		
		public function authenticate($email, $password)
		{
			global $db;

			$sql = "SELECT password FROM " . self::$_table;
			$sql .= " WHERE email=:email"; 
			$sql .= " LIMIT 1;";

			$re = $db->query($sql, array("email"=>$email));
			$resultat = $re->fetch();
			$resultat = $resultat['password'];

			if($password==$resultat)
			{
				
				return true;
			}else
			{
				return false;
			}
		}
		 
		public function create()
		{
			global $db;

			$sql = "INSERT INTO " . self::$_table;
			$sql .= " (" . implode(",",array_keys($this->utilisateur)) . ")";
			$sql .= " values(:".implode(", :",array_keys($this->utilisateur)) . ");";
			
			$re = $db->query($sql, $this->utilisateur);

			if($db->affected_rows($re) > 0)
			{
				return true;
			}
			else
			{
				return false;
			}
		
		}
		
		public function update()
		{
			global $db;

			$shifted = $this->utilisateur;
			array_shift($shifted);
			$array_key_key = array();

			foreach($shifted as $key => $val)
			{
				$array_key_key[] = $key . "=:" . $key;
			}
			
			$sql = "UPDATE " . self::$_table;
			$sql .= " SET ". implode(",", $array_key_key);
			$sql .= " WHERE e_id=:e_id;";
			
			$re = $db->query($sql, $this->utilisateur);

			if($db->affected_rows($re) > 0)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		
		
		abstract protected function find_by_id($id);
		abstract protected function find_by_email($email);
		abstract protected function count_all(); 
		
	
		
	
}
/*
$uti=new utilisateur();
$utilisateur = array("u_id"=>null,
										"nom"=>null,
										"prenom"=>null,
										"email"=>null,
										"password"=>null,
										"adresse"=>null,
										"num_tel"=>null
									);

$sql = "INSERT INTO utilisateur" ;
			$sql .= " (" . implode(",",array_keys($utilisateur)) . ")";
			$sql .= " values(:".implode(", :",array_keys($utilisateur)) . ");";
			
			echo $sql;
			

$uti->set_utilisateur('nom' , 'Ben Moussa');
$uti->set_utilisateur('prenom', 'Salma');
$uti->set_utilisateur('email', 'benmoussasalma1@gmail.com');
$uti->set_utilisateur('password', 'password');
$uti->set_utilisateur('adresse', 'Tanger');
$uti->set_utilisateur('num_tel' , '0612345678');
print_r($uti->get_utilisateur());
if($uti->create()) {
	echo ' OK';
	}
	else echo 'Erreur' ;

*/
    

