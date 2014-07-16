<?php

	require_once("database.php");
	require_once(__DIR__."/../lib/password.php");

	class Etudiant
	{

	  	private static $_table = "etudiant";
		private $etudiant;
		

		public function __construct()
		{
			$this->etudiant = array(
										"e_id"=>null,
										"e_nom"=>null,
										"e_prenom"=>null,
										"e_email"=>null,
										"e_password"=>null,
										"e_cne"=>null,
										"e_tel"=>null,
										"e_photo"=>null,
										"e_validation"=>null,
										//"e_emailcode"=>null
									);
		}
		

		public function authenticate($e_mail, $password)
		{
			global $db;

			$sql = "SELECT e_password FROM " . self::$_table;
			$sql .= " WHERE e_email=:e_email"; 
			$sql .= " LIMIT 1;";

			$re = $db->query($sql, array("e_email"=>$e_mail));
			$resultat = $re->fetch();
			$resultat = $resultat['e_password'];

			if(password_verify($password,$resultat))
			{
				$this->find_by_email($e_mail);
				return true;
			}else
			{
				return false;
			}
		}
		

		public function get_etudiant()
		{
			return $this->etudiant;
		}


		public function set_etudiant($key, $value)
		{
			$this->etudiant[$key] = $value;
		}


		public function find_by_id($id)
		{
			global $db;

			$sql = "SELECT * FROM " . self::$_table;
			$sql .= " WHERE e_id=:id"; 
			$sql .= " LIMIT 1;";

			$re = $db->query($sql, array("id"=>$id));
			$resultat = $re->fetch(PDO::FETCH_ASSOC);

			if(empty($resultat))
			{
				$this->etudiant = array();
			}
			else
			{
				$this->etudiant = $resultat;
			}	
		}

		public function find_by_email($email)
		{
			global $db;
			$sql="select * from ".self::$_table;
			$sql.=" where e_email=:email"; 
			$sql.=" limit 1;";
			$re=$db->query($sql,array("email"=>$email));
			$resultat=$re->fetch(PDO::FETCH_ASSOC);
			if(empty($resultat)) {
				$this->etudiant=array();
			} else {
				$this->etudiant=$resultat;
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


		public function create()
		{
			global $db;

			$sql = "INSERT INTO " . self::$_table;
			$sql .= " (" . implode(",",array_keys($this->etudiant)) . ")";
			$sql .= " values(:".implode(", :",array_keys($this->etudiant)) . ");";
			
			$re = $db->query($sql, $this->etudiant);

			if($db->affected_rows($re) > 0)
			{
				$this->find_by_id($db->last_insert_id());
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

			$shifted = $this->etudiant;
			array_shift($shifted);
			$array_key_key = array();

			foreach($shifted as $key => $val)
			{
				$array_key_key[] = $key . "=:" . $key;
			}
			
			$sql = "UPDATE " . self::$_table;
			$sql .= " SET ". implode(",", $array_key_key);
			$sql .= " WHERE e_id=:e_id;";
			
			$re = $db->query($sql, $this->etudiant);

			if($db->affected_rows($re) > 0)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		
		public static function etudiants()
		{
			global $db;

			$sql = "SELECT *
				    FROM ".self::$_table.";";	
		   
		    $list = array();
			$re = $db->query($sql);
			$list = $re->fetchAll(PDO::FETCH_ASSOC);
			
			return $list;
		}
		
	}


?>