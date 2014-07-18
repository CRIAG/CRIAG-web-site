<?php
require_once("database.php");
require_once("utilisateur.php");
class Admin extends Utilisateur {
	
	public function __construct()
		{ 
		parent::__construct();
		}
		
	public function create()
	{
		global $db;
		if( parent::create())
		{
			$id=$db->last_insert_id();
			$sql= "insert into admin values(:id);";
			$id=$db->last_insert_id();
			$re = $db->query($sql, array("id"=>$id));
			if($db->affected_rows($re)>0)
			{
				
				$this->find_by_id($id);
				return true;
			}else
			{
			  return   false;
			}
		  
		}else
		{
			return false;
		}
	  	
	}
		public function delete(){
			global $db;
			$sql = "set foreign_key_checks = 0;";
			
			$db->query($sql);
			
			$sql = " DELETE FROM admin " ;
			$sql .= " WHERE utilisateur_u_id=:u_id;"; 
			$re = $db->query($sql, array("u_id"=>$this->utilisateur["u_id"]));

			if($db->affected_rows($re) > 0)
			{
				parent::delete() ;
				return true;
			}
			else
			{
				return false;
			}
			
			
			}
	public function find_by_id($id)
		{
			global $db;

			$sql = "SELECT * FROM ".parent::$_table ;
			$sql .= " WHERE u_id=:id" ; 
			$sql .= " and u_id in (select * from admin)";
			$sql .= " LIMIT 1;";

			$re = $db->query($sql, array("id"=>$id));
			$resultat = $re->fetch(PDO::FETCH_ASSOC);

			$this->utilisateur = $resultat;
			
			return $resultat;
		}
		
	public function find_by_email($email)
		{
			global $db;
			$sql="select * from ".parent::$_table;
			$sql.=" where email=:email"; 
			$sql .= " and u_id in (select * from admin)";
			$sql.=" limit 1;";
			$re=$db->query($sql,array("email"=>$email));
			$resultat=$re->fetch(PDO::FETCH_ASSOC);
			
				$this->utilisateur=$resultat;
			return $resultat;
		}

		public function count_all()
		{
			global $db;

			$sql = "SELECT COUNT(*) FROM " . parent::$_table ;
			$sql .=" where u_id in (select * from admin);";

			$re = $db->query($sql);
			$resultat = $re->fetch(PDO::FETCH_ASSOC);
			
			return array_shift($resultat);
		}
	

	public function authenticate($email, $password)
		{
			global $db;

			$sql = "SELECT utilisateur.password FROM 
				  utilisateur inner join admin on utilisateur.u_id = admin.utilisateur_u_id
				   WHERE email=:email
				   LIMIT 1;";

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
	
	
	
	}