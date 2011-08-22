<?php
require_once '../init.php';

$controller = new LoginCotroller();
$controller->doLogin();

Class LoginCotroller{
	public function  doLogin(){
		$userName = trim($_POST["userName"]);
		$password = trim($_POST["password"]);
		if ( empty($userName) ){
			echo "User name required"; return;
		}
		if ( empty( $password ) ) {
			echo "Password required"; return;
		}
		
		// get login
		FilemakerDB::setup("174.3.224.247", "CSISched", "webuser", "webpassword");
		try{
			$login = Login::getByUserName($userName);
		}catch (Exception $ex ){}		
		ob_end_clean();
		
		
		// if login couldn't be found, break.
		if( empty($login) || $login -> UserName != $userName) {
			echo "Wrong Username/Email and password combination.";
			return;
		}
		
		// if password is invalid, break
		if ( $login -> Password != $password) {
			echo "Wrong Username/Email and password combination.";
			return;
		}
		
		self::login($login);
		echo "OK";
	}
	
	/** Performs actual login with login object **/
	function login($login) {
		$login -> Password = "";
		$session = Session::getInstance();
		// Set session login object
		$session->setUserLogin($login);
	}
	
}


?>