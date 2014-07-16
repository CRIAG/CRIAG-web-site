<?php
require_once("database.php");
require_once("utilisateur.php");
class Client extends Utilisateur {
	
	public function __construct()
		{ 
		parent::__construct();
		}
		
	public function find_by_id($id)
		{
			global $db;

			$sql = "SELECT * FROM " . self::$_table;
			$sql .= " WHERE u_id=:id" ; 
			$sql .= "and u_id in (select * from Client)";
			$sql .= " LIMIT 1;";

			$re = $db->query($sql, array("id"=>$id));
			$resultat = $re->fetch(PDO::FETCH_ASSOC);

			if(empty($resultat))
			{
				$this->utilisateur = array();
			}
			else
			{
				$this->utilisateur = $resultat;
			}	
		}
		
	public function find_by_email($email)
		{
			global $db;
			$sql="select * from ".self::$_table;
			$sql.=" where email=:email"; 
			$sql.=" limit 1;";
			$re=$db->query($sql,array("email"=>$email));
			$resultat=$re->fetch(PDO::FETCH_ASSOC);
			if(empty($resultat)) {
				$this->utilisateur=array();
			} else {
				$this->utilisateur=$resultat;
			}	
		}

		public function count_all()
		{
			global $db;

			$sql = "SELECT COUNT(*) FROM " . self::$_table . ";";

			$re = $db->query($sql);
			$resultat = $re->fetch(PDO::FETCH_ASSOC);
			
			return array_shift($resultat);
		}
	
	
	
	
	
	
	
	
	
	
	
	
	}