<?php
session_start();
require_once 'classes/Membership.php';
$membership = new Membership();

// If the user clicks the "Log Out" link on the index page.
if(isset($_GET['status']) && $_GET['status'] == 'loggedout') {
	$membership->log_User_Out();
}

// Did the user enter a password/username and click submit?
if($_POST && !empty($_POST['username']) && !empty($_POST['pwd'])) {
	$response = $membership->validate_User($_POST['username'], $_POST['pwd']);
}
														

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login to access!</title>
<link href="css/my_loginform.css" rel="stylesheet">
<!--<link rel="stylesheet" type="text/css" href="css/default.css" /> -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js"></script>
<!-- <script type="text/javascript" src="js/main.js"></script> -->
</head>

<body>

<div id="wrapper">

	<form name="login-form" class="login-form" action="" method="post">
	
		<div class="header">
		<!--<h2><img src="images/phone-logo-md.png" width="35" height="35" /> Stella PBX </h2>-->
		<h2> <img src="./images/tel-rex-logo.png" width="188" height="50" /> </h2>
		<span>Login to the TelREX Cloud Asterisk.</span>
                <br />
		<span>Login: admin Pass: viter321</span>
                <br />
                <span><?php include($_SERVER['DOCUMENT_ROOT']."/telrex/includes/footer.php"); ?></span>
		</div>
	
		<div class="content">
		<input name="username" type="text" class="input username" placeholder="Username" value="admin"/>
		<div class="user-icon"></div>
		<input name="pwd" type="password" class="input password" placeholder="Password" value="viter321"/>
		<div class="pass-icon"></div>		
		</div>

		<div class="footer">
		<input type="submit" name="submit" value="Login" class="button" />
	
                
		</div>
	
	</form>

</div>
<!--<div class="gradient"></div>
-->


</body>
</html>
