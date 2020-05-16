<?php 
require 'session.php';
require 'crud.php';	
require 'helper.php';
require 'config.php';
class Category implements Crud{
	private $table;
	private $name;
	private $db;
	private $con;
	private $token;
	public $arr = array();
	public function __construct(){
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST, GET');
		$this->db =  new Database();
		$this->con = $this->db->getConnection();
		$this->token = new Helper($_POST['token']);
		$this->token = $this->token->token;
		$this->table = $GLOBALS['config']['master']['table']['category_tbl'];
	}
	
	public function create(){
		if ($_POST['token'] == $this->token){
			$this->name = $_POST['name'];
			//Normal approach no security
			//$insertQuery = 'INSERT INTO '.$this->table.' (name) VALUES ("'.$this->name.'")';
			// $result = $this->db->connection->query($insertQuery);
			//********

			//Prepare approach has security
			try{	
				$insertQuery = $this->db->connection->prepare('INSERT INTO '.$this->table.' (name) VALUES (?)');
				if (!$insertQuery){
					throw new Exception();
				}
				$insertQuery->bind_param("s", $this->name);
				$result = $insertQuery->execute();
			}catch(Exception $e){
				echo json_encode(['data' => null, 'error' => $this->table.' is undefined. '.$e]);
				exit;
			}
			//********

			if ($result){
				echo json_encode(['data' => 'inserted successfully', 'error' => null]);
			}else{
				echo json_encode(['data' => null, 'error' => 'error inserting in database']);
			}
		}else{
			echo json_encode(['data' => null, 'error' => 'Token mismatch']);
		}
	}
	public function update(){
		if ($_POST['token'] == $this->token){
			$this->name = $_POST['name'];
			if (!empty($_GET['id'])){
				$id = $_GET['id'];
				$updateQuery = 'UPDATE '.$this->table.' SET name="'.$this->name.'" WHERE id="'.$id.'"';
				$result = $this->db->connection->query($updateQuery);
			}else{
				echo json_encode(['data' => null, 'error' => 'ID is not defined']);
				$result = false;
				exit;
			}
			if ($result){
				echo json_encode(['data' => 'data updated successfully', 'error' => null]);
			}else{
				echo json_encode(['data' => null, 'error' => 'error updating in database']);
			}
		}else{
			echo json_encode(['data' => null, 'error' => 'Token mismatch']);
		}
	}
	public function list(){
		if ($_POST['token'] == $this->token){
			$selectQuery = 'SELECT * FROM '.$this->table;
			$result = $this->db->connection->query($selectQuery);
			if ($result->num_rows > 0){
	            while ($row = $result->fetch_assoc()){
	            	$data['id'] = $row['id'];
	            	$data['name'] = $row['name'];
	            	$data['status'] = $row['status'];
	            	array_push($this->arr, $data);
	            }
	            echo json_encode(array('data' => $this->arr, 'error' => null));
			}else{	
				echo json_encode(array('data' => null, 'error' => 'No records found'));
			}
		}else{
			echo json_encode(array('data' => null, 'error' => 'Token mismatch'));
		}
	}
	public function delete(){
		if ($_POST['token'] == $this->token){
			$status = -1;
			if (!empty($_GET['id'])){
				$id = $_GET['id'];
				$deleteQuery = 'UPDATE '.$this->table.' SET status="'.$status.'" WHERE id="'.$id.'"';
				$result = $this->db->connection->query($deleteQuery);
			}else{
				echo json_encode(['data' => null, 'error' => 'ID is not defined']);
				$result =  false;
				exit;
			}
			if ($result){
				echo json_encode(['data' => 'record deleted successfully', 'error' => null]);
			}else{
				echo json_encode(['data' => null, 'error' => 'error deleting record']);
			}
		}else{
			echo json_encode(['data' => null, 'error' => 'Token mismatch']);
		}
	}
}
$category = new Category();
if ($_GET['type'] == 'list'){
	$category->list();
}else if ($_GET['type'] == 'create'){
	$category->create();
}else if ($_GET['type'] == 'update'){
	$category->update();
}else if ($_GET['type'] == 'delete'){
	$category->delete();
}else{
	echo json_encode(['data' => null, 'error' => 'Type undefined']);
}
?>