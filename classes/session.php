<?php

	/* 
		================  Class Session ===============

		==== Attributes:    
						$_loged_in 
						$_user_id  
						$_client 
						$_message  

		==== Methodes :   
						__construct(); 
						is_logedin();  
						get_user_id();
						set_user_id($id);
						is_client();
						login($id, $client);
						logout();
						check_login();
						is_there_any_msg();
						
		===============================================
	*/

class Session {

	private  $_loged_in = false;
	private  $_user_id;
	private  $_client = false;
	private $_message;
	

	public function __construct()
	{
	      session_start();

		  $this->is_there_any_msg();
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
	 * is_client
	 *
	 *verifier si l'utilisateur est un client ou prof
	 *
	 *@params non
	 *@return non
	 *
	*/
	public function is_client()
	{
		return $this->_client;
	}


	/**
	 * login
	 *
	 *creer une session d'utilisateur
	 *
	 *@params int $id ,bool $client
	 *@return non
	 *
	*/
	public function login($id, $client)
	{
		$_SESSION["user_id"] = $id;
		$_SESSION["client"] = $client;

		$this->_loged_in = true;
		$this->_user_id = $id;
		$this->_client = $client;
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
			$this->_client = false;

			unset($_SESSION["user_id"]);
			unset($_SESSION["client"]);
			unset($this->_user_id);

			
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
			$this->_client = $_SESSION["client"];
			$this->_loged_in = true;	
		}
		else
		{
			$this->_loged_in = false;
			$this->_client = false;
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


	

	
	
}
?>