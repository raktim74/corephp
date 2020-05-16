<?php 
require 'index.php';
class Helper{
	public $token;
	private $db;
	private $conn;
	public function __construct($token){
		$this->db =  new Database();
		$this->conn = $this->db->getConnection();
		$selectQuery = 'SELECT * FROM token';
		$result = $this->db->connection->query($selectQuery);
		if ($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
            	$this->token = $row['token'];	
            }
            return $this->token;
		}else{	
			return null;
		}
	}
}
?>