<?php

	/* 
		================  Class Session ===============

		==== Attributes:    
						$_loged_in 
						$_user_id  
						$_etudiant 
						$_message  

		==== Methodes :   
						__construct(); 
						is_logedin();  
						get_user_id();
						set_user_id($id);
						is_etudiant();
						login($id, $etudiant);
						logout();
						check_login();
						is_there_any_msg();
						remember_me();
						is_there_cookie();

		===============================================
	*/

class Session {

	private  $_loged_in = false;
	private  $_user_id;
	private  $_etudiant = false;
	private $_message;
	

	public function __construct()
	{
	      session_start();

		  $this->is_there_any_msg();
		  $this->is_there_cookie();
		  $this->check_login();		 
	}


	/**
	 * is_logedin
	 *
	 *verifier si l'utulisateur est logedin
	 *
	 *
	 *@return bool true or false
	 *
	*/
	public function is_logedin()
	{
		return  $this->_loged_in;
	}


	/**
	 * get_user_id
	 *
	 *getter
	 *
	 *@params non
	 *@return user_id
	 *
	*/
	public function get_user_id()
	{
		return $this->_user_id;
	}


	/**
	 * set_user_id
	 *
	 *setter
	 *
	 *@params $id
	 *@return non
	 *
	*/
	public function set_user_id($id)
	{
		if (is_int($id))
		{
			$this->_user_id = $id;
		}
		else
		{
			die("var id is not an int");
		}
	}


	/**
	 * is_etudiant
	 *
	 *verifier si l'utilisateur est un etudiant ou prof
	 *
	 *@params non
	 *@return non
	 *
	*/
	public function is_etudiant()
	{
		return $this->_etudiant;
	}


	/**
	 * login
	 *
	 *creer une session d'utilisateur
	 *
	 *@params int $id ,bool $etudiant
	 *@return non
	 *
	*/
	public function login($id, $etudiant)
	{
		$_SESSION["user_id"] = $id;
		$_SESSION["etudiant"] = $etudiant;

		$this->_loged_in = true;
		$this->_user_id = $id;
		$this->_etudiant = $etudiant;
	}


	/**
	 * logout
	 *
	 *detruire la session
	 *
	 *@params non
	 *@return non
	 *
	*/
	public function logout()
	{
		if ($this->_loged_in)
		{
			$this->_loged_in = false;
			$this->_etudiant = false;

			unset($_SESSION["user_id"]);
			unset($_SESSION["etudiant"]);
			unset($this->_user_id);

			setcookie("auth", "", time(), "/", "localhost", false, true);
		}
	}


	/**
	 * check_login
	 *
	 *verifier si une session existe
	 *
	 *@params non
	 *@return non
	 *
	*/
	public function check_login()
	{
		if(isset($_SESSION["user_id"]))
		{
		    $this->_user_id = $_SESSION["user_id"];
			$this->_etudiant = $_SESSION["etudiant"];
			$this->_loged_in = true;	
		}
		else
		{
			$this->_loged_in = false;
			$this->_etudiant = false;
			unset($this->_user_id);
		}
	}


	/**
	 * is_there_any_msg
	 *
	 *verifier si il existe un messaage dans la session
	 *
	 *@params non
	 *@return non
	 *
	*/
	public function is_there_any_msg()
	{
		if(isset($_SESSION["message"]))
		{
			$this->_message = $_SESSION["message"];
			unset($_SESSION["message"]);
		}
		else
		{
			$this->_message="";
		}
	}


	/**
	 * message
	 *
	 *met  un message  dans la session ou l'affiche
	 *
	 *@params string $msg
	 *@return non ou $msg
	 *
	*/
	public function message($msg = "")
	{
		if(!empty($msg))
		{
			$_SESSION["message"] = $msg;
		}
		else
		{	
			return $this->_message;
		}
	}


	/**
	 * remember_me
	 *
	 *creer un cookie valide pour 7 jours 
	 *
	 *@params non
	 *@return noo
	 *
	*/
	public function remember_me()
	{
		//user id must be crypted and compared with user email and password
		setcookie("auth", $this->_user_id."-".$this->_etudiant, time()+3600*24*7, "/", "localhost", false, true);
	}


	/**
	 * is_there_cookie
	 *
	 *lorsq'on quite le navigateur et on revient 
	 *cette fonctio s'ocupe d'extraire les donne de cookie et les met dans la session 
	 *
	 *@params non
	 *@return noo
	 *
	*/
	public function is_there_cookie()
	{
		if(!isset($_SESSION["user_id"]) && isset($_COOKIE["auth"]))
		{
			$data_array = explode("-", $_COOKIE["auth"]);
			$_SESSION["user_id"] = $data_array[0]; 
			$_SESSION["etudiant"] = $data_array[1];
		}
	}
	
}
?>