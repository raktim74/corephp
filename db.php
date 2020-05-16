<?php 
require 'config.php';
class Database{
	private $host;
	private $username;
	private $password;
	private $database;
	public $connection;
	public function getConnection(){
		$this->connection = null;
		try{
			$this->host = $GLOBALS['config']['master']['database']['host'];
			$this->username = $GLOBALS['config']['master']['database']['username'];
			$this->password = $GLOBALS['config']['master']['database']['password'];
			$this->database = $GLOBALS['config']['master']['database']['database'];
			$this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);
			if (!$this->connection->connect_error){
				//echo 'connected';
			}
		}catch(Exception $e){
			echo 'Error '.$e; 
		}
	}
}

?>