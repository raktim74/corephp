<?php 
require 'index.php';
require 'session.php';
class Registerlogin{
	private $db;
	private $con;
	private $table;
	function __construct(){
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST, GET');
		$this->db = new Database();
		$this->con = $this->db->getConnection();
		$this->table = $GLOBALS['config']['master']['table']['registration_tbl'];
	}
	public function register(){
		$name = $_POST['name'];
		$email = $_POST['email'];
		$password = md5($_POST['password']);
		//Normal approach
		$insertQuery = 'INSERT INTO '.$this->table.' (name, email, password) VALUES ("'.$name.'", "'.$email.'", "'.$password.'")';
		$result = $this->db->connection->query($insertQuery);
		if ($result){
			echo json_encode(['data' => 'Registration is successfull', 'error' => null]);
		}else{
			echo json_encode(['data' => null, 'error' => 'error while registering']);
		}
	}
	public function login(){
		$email = $_POST['email'];
		$password = md5($_POST['password']);
		$selectQuery = 'SELECT * FROM '.$this->table.' WHERE email="'.$email.'" AND password="'.$password.'"';
		$result = $this->db->connection->query($selectQuery);
		if ($result->num_rows > 0){	
			$name = $result->fetch_row()[1];
			$session = new Session();
			$session->setSession(array(
				'email' => $email,
				'name' => $name
			));
			echo json_encode(['data' => 'Logged in successfully', 'error' => null]);
		}else{
			echo json_encode(['data' => null, 'error' => 'Invalid email or password']);
		}
	}
	public function logout(){
		$session = new Session();
		$session->unsetSession();
	}

}
$registerLogin = new Registerlogin();
if ($_GET['type'] == 'register'){
	$registerLogin->register();
}else if ($_GET['type'] == 'login'){
	$registerLogin->login();
}else if ($_GET['type'] == 'logout'){
	$registerLogin->logout();
}else{
	echo json_encode(['data' => null, 'error' => 'Type is undefined']);
}


?>