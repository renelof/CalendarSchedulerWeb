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
			$contractor = Contractor::getByEmail($userName);
		}catch (Exception $ex ){}		
		ob_end_clean();
		
		
		// if login couldn't be found, break.
		if( empty($contractor) || $contractor -> Email != $userName) {
			echo "Wrong Email and password combination.";
			return;
		}
		
		// if password is invalid, break
		if ( $contractor -> Password != $password) {
			echo "Wrong Email and password combination.";
			return;
		}
		
		self::login($contractor);
		echo "OK";
	}
	
	/** Performs actual login with login object **/
	function login($contractor) {
		$contractor -> Password = "";
		$session = Session::getInstance();
		// Set session login object
		$session->setUserLogin($contractor);
	}
	
}


?>