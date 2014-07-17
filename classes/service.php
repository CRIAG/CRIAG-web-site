<?php 
require_once("database.php");


 class Service { 
      private static $_table = "service";
		private $service;
		
		public function __construct()
		{
			$this->service = array(	"svc_id"=>null,
										"svc_nom"=>null,
										"svc_type"=>null
									);
		}
		
		
		public function set_service($key, $value)
		{
			$this->service[$key] = $value;
		}
		
		public function get_service()
		{
			return $this->service;
		}
		
		 
		public function create()
		{
			global $db;

			$sql = "INSERT INTO " . self::$_table;
			$sql .= " (" . implode(",",array_keys($this->service)) . ")";
			$sql .= " values(:".implode(", :",array_keys($this->service)) . ");";
			//echo $sql;
			$re = $db->query($sql, $this->service);

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
			$sql .= " WHERE svc_id=:id;"; 
			$re = $db->query($sql, array("id"=>$this->service["svc_id"]));

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

			$shifted = $this->service;
			array_shift($shifted);
			$array_key_key = array();

			foreach($shifted as $key => $val)
			{
				$array_key_key[] = $key . "=:" . $key;
			}
			
			$sql = "UPDATE " . self::$_table;
			$sql .= " SET ". implode(",", $array_key_key);
			$sql .= " WHERE svc_id=:svc_id;";
			
			$re = $db->query($sql, $this->service);

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
			$sql .= " WHERE svc_id=:id" ; 
			$sql .= " LIMIT 1;";

			$re = $db->query($sql, array("id"=>$id));
			$resultat = $re->fetch(PDO::FETCH_ASSOC);

			$this->service = $resultat;
			
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

	
		
	
}
 


?>