<?php 
session_start();
class Session{
	public function setSession(... $data){
		foreach ($data as $key => $val){
			$_SESSION[$key] = $val;
		}
	}
	public function unsetSession(){
		session_destroy();
	}
}

?>