<?php

class Login extends FastModel{
	public static $layout = 'Logins';
	
	public static $id = 'LoginID';
	
	public function __construct() {
		
	}
	
	public static function getByUserName($userName) {
		return self::where(array('UserName' => '=='.str_replace("@","\@",$userName)), true);
	}
	
}
?>