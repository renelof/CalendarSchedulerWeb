<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title> Calendar Scheduler System</title>
<link rel="stylesheet" type="text/css" href="view/assets/css/main.css" />
<link rel="stylesheet" type="text/css" href="assets/css/main.css" />
<link href='http://fonts.googleapis.com/css?family=Lato:normal' rel='stylesheet' type='text/css' />

<script type="text/javascript" src="assets/js/jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.flash.js"></script>
<script>
$(document).ready(function() {
	$('#flashplayer').flash({
		src: 'assets/flash/CalendarScheduler.swf',
		width: "100%",
		height: "100%",
		allowscriptaccess: "always"
	});
});
</script>
</head>
<body>
<?php
require_once '../init.php';
$session = Session::getInstance();
$userLogin = $session->getUserLogin();
if ( empty( $session ) || empty( $userLogin ) ){
?>
<div style="text-align: center;">
	<div  id="loginRequired">
	<h1>Login is required</h1>
	<a href="../">Login</a>
	</div>
</div>
<?php
} else{	
?>
<div id="flashplayer" style="width: 1150px;height: 850px;"></div>
<?php
} 
?>
</body>
</html>