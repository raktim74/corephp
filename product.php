<?php 
require 'crud.php';	
require 'helper.php';
require 'config.php';
class Product implements Crud{
	private $table;
	private $category_id;
	private $title;
	private $description;
	private $db;
	private $con;
	private $token;
	public function __construct(){
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST, GET');
		$this->db = new Database();
		$this->con = $this->db->getConnection();
		$this->token = new Helper($_POST['token']);
		$this->token = $this->token->token;
		$this->table = $GLOBALS['config']['master']['table']['product_tbl'];
	}
	public function create(){
		if ($_POST['token'] == $this->token){
			$this->title = $_POST['title'];
			$this->category_id = $_POST['category_id'];
			$this->description = $_POST['description'];	
			//Normal approach for insert query
			// $insertQuery = 'INSERT INTO '.$this->table.' (title, category_id, description) VALUES ("'.$this->title.'", "'.$this->category_id.'", "'.$this->description.'")';
			// $result = $this->db->connection->query($insertQuery);
			//***************

			//Prepare statemenet approach
			try{
				$insertQuery = $this->db->connection->prepare('INSERT INTO '.$this->table.'(title, description, category_id) VALUES (?,?,?)');
				if (!$insertQuery){
					throw new Exception();
				}
				$insertQuery->bind_param('ssi', $this->title, $this->description, $this->category_id);
				$result = $insertQuery->execute();

			}catch (Exception $e){
				echo json_encode(['data' => null, 'error' => $this->table.' is undefined']);
				exit;
			}
			if ($result){
				echo json_encode(['data' => 'data inserted successfully', 'error' => null]);
			}else{
				echo json_encode(['data' => null, 'error' => 'error inserting into database']);
			}
		}else{
			echo json_encode(['data' => null, 'error' => 'Token mismatch']);
		}
	}
	public function update(){
		if ($_POST['token'] == $this->token){
			if (!empty($_GET['id'])){
				$id = $_GET['id'];
				$this->title = $_POST['title'];
				$this->description = $_POST['description'];
				$this->category_id = $_POST['category_id'];
				$updateQuery = 'UPDATE '.$this->table.' SET title="'.$this->title.'", description="'.$this->description.'", category_id="'.$this->category_id.'" WHERE id='.$id;
				$result = $this->db->connection->query($updateQuery);
				if ($result){
					echo json_encode(['data' => 'data updated successfully', 'error' => null]);
				}else{
					echo json_encode(['data' => null, 'error' => 'error updating data']);
				}
			}else{
				echo json_encode(['data' => null, 'error' => 'ID is undefined']);
			}
		}else{
			echo json_encode(['data' => null, 'error' => 'Token mismatch']);
		}
	}
	public function delete(){
		if ($_POST['token'] == $this->token){
			$status = -1;
			if (!empty($_GET['id'])){
				$id = $_GET['id'];
				$deleteQuery = 'UPDATE '.$this->table.' SET status='.$status.' WHERE id='.$id;
				$result = $this->db->connection->query($deleteQuery);
				if ($result){
					echo json_encode(['data' => 'data deleted successfully', 'error' => null]);
				}else{	
					echo json_encode(['data' => null, 'error' => 'error deleting record']);
				}
			}else{
				echo json_encode(['data' => null, 'error' => 'ID is undefined']);
			}
		}else{
			echo json_encode(['data' => null, 'error' => 'Token mismatch']);
		}
	}
	public function list(){
		if ($_POST['token'] == $this->token){
			$arr = array();
			$selectQuery = 'SELECT * FROM '.$this->table;
			$result = $this->db->connection->query($selectQuery);
			if ($result->num_rows > 0){
				while ($row = $result->fetch_assoc()){
					$data['id'] = $row['id'];
					$data['category_id'] = $row['category_id'];
					$data['title'] = $row['title'];
					$data['description'] = $row['description'];
					array_push($arr, $data);
				}
				echo json_encode(['data' => $arr, 'error' => null]);
			}else{
				echo json_encode(['data' => null, 'error' => 'No records found']);
			}
		}else{	
			echo json_encode(['data' => null, 'error' => 'Token mismatch']);
		}
	}
	public function product_search($title){
		if ($_POST['token'] == $this->token){
			$arr_search = array();
			if ($title != ''){
				$searchQuery = 'SELECT * from '.$this->table.' WHERE title LIKE "%'.$title.'%"';
			}else{
				$searchQuery = 'SELECT * from '.$this->table;
			}
			$result = $this->db->connection->query($searchQuery);
			if ($result->num_rows > 0){
				while ($row = $result->fetch_assoc()){
					$data['id'] = $row['id'];
					$data['title'] = $row['title'];
					$data['category_id'] = $row['category_id'];
					$data['description'] = $row['description'];
					array_push($arr_search, $data);
				}
				echo json_encode(['data' => $arr_search, 'error' => null]);
			}else{
				echo json_encode(['data' => null, 'error' => 'no records found']);
			}
		}else{
			echo json_encode(['data' => null, 'error' => 'Token mismatch']);
		}
	}
}
$product = new Product();
if ($_GET['type'] == 'list'){
	$product->list();
}else if ($_GET['type'] == 'create'){
	$product->create();
}else if ($_GET['type'] == 'update'){
	$product->update();
}else if($_GET['type'] == 'delete'){
	$product->delete();
}else if($_GET['type'] == 'search'){
	$product->product_search($_GET['search']);
}else{
	echo json_encode(['data' => null, 'error' => 'Type undefined']);
}

?>