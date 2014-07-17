<?php
require(__DIR__."/../includes/config.php");

class Database{

	protected $_db;
	
	public function __construct()
	{
		$this->set_db();
	}

	/**=======================================
	 * set_db
	 *
	 *initialiser $_db avec une connexion à la BD
	 *
	 *@prams non
	 *@return non
	 *
	*/
	public function set_db()
	{
		$this->_db = new PDO('mysql:host=' . DB_SERVER . ';dbname=' . DB_NAME . ';charset=gbk', DB_USER, DB_PASS);	
	}

	/**=======================================
	 * close_connection
	 *
	 * fermer la connexion
	 *
	 *@prams non
	 *@return non
	 *
	*/
	public function close_connection()
	{
		$this->_db = null;
	}

	/**=======================================
	 * query
	 *
	 * executer une requete SQL
	 *
	 *@param string $sql la requete
	 *@param array $data les données preparées
	 *@return objet $q resultat de l'execution
	 *
	*/
	public function query($sql, $data = array())
	{
		$this->_db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		
		$q = $this->_db->prepare($sql);
		try {
		$q->execute($data); 	
		} catch (PDOException $e) {
		echo $e->getMessage();
		}
		 	
		return $q;
		}

	/**=======================================
	 * last_insert_id
	 *
	 * le dernier id inseré
	 *
	 *@param non
	 *@return int le dernier id inseré
	 *
	*/
	public function last_insert_id()
	{
		return $this->_db->lastInsertId();
	}

	/**=======================================
	 * affected_rows
	 *
	 * le nombre de lignes qui ont été affectés 
	 *
	 *@param object $re resulta de query() 
	 *@return int le nombre de lignes affectés
	 *
	*/
	public function affected_rows($re)
	{
		return $re->rowCount();	
	}
}

$db = new Database();
/*
	$sql="insert into etudiant (E_nom,E_prenom) values (:E_nom,:E_prenom)";
	$data=array("E_nom"=>"otmane","E_prenom"=>"el guenouni");
	$re=$db->query($sql,$data);
	echo $db->affected_rows($re)."<br>";
	echo $db->last_insert_id()."<br>";

	$db->close_connection();
*/

?>