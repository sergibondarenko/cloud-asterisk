<?php
session_start();
$redirect_url = $_SESSION['redirect_url'];
header("location: $redirect_url");
//header("location:javascript://history.go(-1)");

echo $_SESSION['redirect_url'];

if (isset ($_POST['save'])) {
	//echo "hello"; 
	require_once('../phpagi/phpagi-asmanager.php');
	$asm = new AGI_AsteriskManager();
	if($asm->connect("127.0.0.1","phpagi","bora123wind"))
	{
		$asm->command("reload");
		$asm->disconnect();
	}
}
?>