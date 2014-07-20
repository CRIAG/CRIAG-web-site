<?php 
require_once("database.php");


 class Commentaire { 
      private static $_table = "commentaire";
		private $commentaire;
		
		public function __construct()
		{
			$this->commentaire = array(	"cmt_id"=>null,
										"cmt_text"=>null,
										"cmt_date"=>null,
										"reclamation_re_id"=>null,
										"admin_utilisateur_u_id"=>null,
										"vue"=>null
									);
		}
		
		
		public function set_commentaire($key, $value)
		{
			$this->commentaire[$key] = $value;
		}
		
		public function get_commentaire()
		{
			return $this->commentaire;
		}
		
		 
		public function create()
		{
			global $db;

			$sql = "INSERT INTO " . self::$_table;
			$sql .= " (" . implode(",",array_keys($this->commentaire)) . ")";
			$sql .= " values(:".implode(", :",array_keys($this->commentaire)) . ");";
			//echo $sql;
			
			$re = $db->query($sql, $this->commentaire);

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
			$sql .= " WHERE cmt_id=:id;"; 
			$re = $db->query($sql, array("id"=>$this->commentaire["cmt_id"]));

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

			$shifted = $this->commentaire;
			array_shift($shifted);
			$array_key_key = array();

			foreach($shifted as $key => $val)
			{
				$array_key_key[] = $key . "=:" . $key;
			}
			
			$sql = "UPDATE " . self::$_table;
			$sql .= " SET ". implode(",", $array_key_key);
			$sql .= " WHERE cmt_id=:cmt_id;";
			
			$re = $db->query($sql, $this->commentaire);

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
			$sql .= " WHERE cmt_id=:id" ; 
			$sql .= " LIMIT 1;";

			$re = $db->query($sql, array("id"=>$id));
			$resultat = $re->fetch(PDO::FETCH_ASSOC);

			$this->commentaire = $resultat;
			
			return $resultat;
		}
		
		public function count_all()
		{
			global $db;

			$sql = " SELECT COUNT(*) FROM " .self::$_table ;
			

			$re = $db->query($sql);
			$resultat = $re->fetch(PDO::FETCH_ASSOC);
			
			return array_shift($resultat);
		}
	
		
	
}