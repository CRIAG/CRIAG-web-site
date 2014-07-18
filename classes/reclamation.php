<?php 
require_once("database.php");


 class Reclamation { 
      private static $_table = "reclamation";
		private $reclamation;
		
		public function __construct()
		{
			$this->reclamation = array(	"re_id"=>null,
										"service_id"=>null,
										"re_date"=>null,
										"client_utilisateur_u_id"=>null,
										"re_text"=>null,
										"vue"=>null
									);
		}
		
		
		public function set_reclamation($key, $value)
		{
			$this->reclamation[$key] = $value;
		}
		
		public function get_reclamation()
		{
			return $this->reclamation;
		}
		
		 
		public function create()
		{
			global $db;

			$sql = "INSERT INTO " . self::$_table;
			$sql .= " (" . implode(",",array_keys($this->reclamation)) . ")";
			$sql .= " values(:".implode(", :",array_keys($this->reclamation)) . ");";
			//echo $sql;
			$re = $db->query($sql, $this->reclamation);

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
		public function delete(){
			global $db;
			$sql = "set foreign_key_checks = 0;";
			$db->query($sql);
			
			$sql = " DELETE FROM " .self::$_table;
			$sql .= " WHERE re_id=:id;"; 
			$re = $db->query($sql, array("id"=>$this->reclamation["re_id"]));

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

			$shifted = $this->reclamation;
			array_shift($shifted);
			$array_key_key = array();

			foreach($shifted as $key => $val)
			{
				$array_key_key[] = $key . "=:" . $key;
			}
			
			$sql = "UPDATE " . self::$_table;
			$sql .= " SET ". implode(",", $array_key_key);
			$sql .= " WHERE re_id=:re_id;";
			
			$re = $db->query($sql, $this->reclamation);

			if($db->affected_rows($re) > 0)
			{
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

			$sql = "SELECT * FROM ".self::$_table ;
			$sql .= " WHERE re_id=:id" ; 
			$sql .= " LIMIT 1;";

			$re = $db->query($sql, array("id"=>$id));
			$resultat = $re->fetch(PDO::FETCH_ASSOC);

			$this->reclamation = $resultat;
			
			return $resultat;
		}
		
		public function count_all()
		{
			global $db;

			$sql = "SELECT COUNT(*) FROM " .self::$_table ;
			

			$re = $db->query($sql);
			$resultat = $re->fetch(PDO::FETCH_ASSOC);
			
			return array_shift($resultat);
		}
		
		public static function mes_commentaires($re_id)
	{
		global $db;

			$sql = " SELECT *
				    FROM commentaire  where reclamation_re_id=:id;";	
		   
		    $list = array();
			$re = $db->query($sql,array("id"=>$re_id));
			$list = $re->fetchAll(PDO::FETCH_ASSOC);
			
			return $list;
	
	}
	public static function commentaires_counts($re_id)
	{
		global $db;

			$sql = " SELECT count(*)
				    FROM commentaire  where reclamation_re_id=:id;";	
		   
			$re = $db->query($sql,array("id"=>$re_id));
			$resultat = $re->fetch(PDO::FETCH_ASSOC);
			
			return array_shift($resultat);
	
	}


	
		
	
}
 


?>