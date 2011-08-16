<?php
require_once '../init.php';
//Login::where(array('UserName' => 'james.strong@etherpros.com'), true);
if ( $_POST['userName'] == null ){
	echo "UserName is required";
}elseif ( $_POST['password'] == null ){
	echo "Password is required";
}else{	
	$userName =  $_POST['userName'];
	FilemakerDB::setup("174.3.224.247", "CSISched", "Etherpros", "M3x1c0");
	$login =  Login::where( array('UserName' => 'mike@gmail.com') , true);
	if ($login != null && $login->Password == $_POST['password'] ){
		echo "OK";
	}else{
		echo "Wrong Username/Email and password combination.";
	}
}

?>