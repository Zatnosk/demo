<?php
class Data {
	const HASH_COST = 10;

	public static function get_user_id_and_hash($username){
		$query = Data::query("SELECT id, password_hash FROM users WHERE username=?",$username):
		$id = 0;
		$hash = '';
		return [$id,$hash];
	}

	public static function create_user($username, $password){
		$hash = password_hash($password, PASSWORD_DEFAULT, ['cost'=>Data::HASH_COST]);
		Data::query("INSERT INTO users (username,password_hash) VALUES (?,?)",$username,$hash);
		$id = 0;
		return $id;
	}

	private static function query($sql, ...$values){

	}
}

class User {
	private const SESSION_PREFIX = 'demo';

	private $id;

	public static function login($username, $password){
		list($id,$hash) = Data::get_user_id_and_hash($username);
		if(password_verify($password,$hash)){
			$user = new User($id);
			$user->write_session();
			return $user;
		}
	}

	public static function read_session(){
		$key = User::SESSION_PREFIX.'user_id';
		if(isset($_SESSION[$key])){
			$id = $_SESSION[$key];
			$user = new User($id);
			return $user;
		}
	}

	public function logout(){
		$this->unwrite_session();
	}

	private function write_session(){
		$_SESSION[User::SESSION_PREFIX.'user_id'] = $this->id;
	}

	private function unwrite_session(){
		$_SESSION[User::SESSION_PREFIX.'user_id'] = null;
	}

	private function __construct($user_id){
		$this->id = $user_id;
	}
}

?>