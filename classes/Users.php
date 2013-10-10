<?php

class Users
{
	private $db_connection = null;
	
	public $error = "";
	
	public $users = array();
	
	public function __construct()
	{
		$this->getUsers();
	}
	
	private function getUsers(){
		
		$this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		
		if (!$this->db_connection->connect_errno) {
			$filas = $this->db_connection->query("SELECT * FROM users order by plantel, user_name");
			while($fil = $filas->fetch_array()) $this->users[] = $fil;
		} else {
			$this->error = "no se puede establecer la conexión con la base de datos.";
		}
	}
}