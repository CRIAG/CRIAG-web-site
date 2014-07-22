<?php
require_once("database.php");
require_once("utilisateur.php");
require_once(__DIR__."/../includes/lib/password.php");
class Client extends Utilisateur {
	
	public function __construct()
		{ 
		parent::__construct();
		}
		
	public function create()
	{
		global $db;
		if(  parent::create())
		{
			$id=$db->last_insert_id();
			$sql= "insert into client values(:id);";
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
			
			$sql = " DELETE FROM client " ;
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
			$sql .= " and u_id in (select * from Client)";
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
			$sql .= " and u_id in (select * from Client)";
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
			$sql .=" where u_id in (select * from client);";

			$re = $db->query($sql);
			$resultat = $re->fetch(PDO::FETCH_ASSOC);
			
			return array_shift($resultat);
		}
	
	
	
	public function authenticate($email, $password)
		{
			global $db;

			$sql = "SELECT utilisateur.password FROM 
				  utilisateur inner join client on utilisateur.u_id = client.utilisateur_u_id
				   WHERE email=:email
				   LIMIT 1;";

			$re = $db->query($sql, array("email"=>$email));
			$resultat = $re->fetch();
			$resultat = $resultat['password'];

			if(password_verify($password,$resultat))
			{
				$this->find_by_email($email);
				return true;
			}else
			{
				return false;
			}
		}
		
		public function beneficier($svc_id)
		{
			global $db;
			$sql= "insert into beneficier values(:client_id,:svc_id);";
			$re = $db->query($sql, array("client_id"=>$this->utilisateur["u_id"],"svc_id"=>$svc_id));
			if($db->affected_rows($re)>0)
			{
				
				return true;
			}else
			{
			  return   false;
			}
		}
	   
	   public function delete_beneficier($svc_id)
		{
			global $db;
			$sql= "delete from  beneficier where client_utilisateur_u_id=:client_id and service_svc_id=:svc_id;";
			$re = $db->query($sql, array("client_id"=>$this->utilisateur["u_id"],"svc_id"=>$svc_id));
			if($db->affected_rows($re)>0)
			{
				
				return true;
			}else
			{
			  return   false;
			}
		}
	
	
	public function mes_services()
	{
		global $db;

			$sql = "SELECT service.svc_id,service.svc_nom,service.svc_type
					FROM service inner join  beneficier on beneficier.service_svc_id=service.svc_id
					where client_utilisateur_u_id=:id;";	
							   
		    $list = array();
			$re = $db->query($sql,array("id"=>$this->utilisateur["u_id"]));
			$list = $re->fetchAll(PDO::FETCH_ASSOC);
			
			return $list;
	
	}
	
	public function mes_reclamations($offset=0)
	{
		global $db;

			$sql = " SELECT *
				    FROM reclamation  where client_utilisateur_u_id=:id
					order by re_id desc
					limit ".(int)trim($offset).",10;";	
		 
		    $list = array();
			$re = $db->query($sql,array("id"=>$this->utilisateur["u_id"]));
			$list = $re->fetchAll(PDO::FETCH_ASSOC);
			
			return $list;
	
	}
	
	
	
	
	
	
	}