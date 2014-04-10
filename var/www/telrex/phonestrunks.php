<?php

require_once 'classes/Membership.php';
$membership = New Membership();
$membership->confirm_Member();

session_start();
$_SESSION['redirect_url'] = $_SERVER['PHP_SELF'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.sergibondarenko.com/2012/xhtml">

<html xmlns="http://www.sergibondarenko.com/2012/xhtml" xml:lang="en" lang="en">

<head>

<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		
		<title>Stella PBX</title>

		<!--<style type="text/css">
			@import "css/demo_page.css";
			@import "css/jquery.dataTables.css";
			@import "css/dataTables.tabletools.css";
			@import "css/dataTables.editor.css";
			
		</style>-->
                 <!--<link href="css/demo_page.css" rel="stylesheet"> -->
                 <link href="css/jquery.dataTables.css" rel="stylesheet">
                 <link href="css/dataTables.tabletools.css" rel="stylesheet"> 
                 <link href="css/dataTables.editor.css" rel="stylesheet">
                 <link href="examples/content/shared/styles/examples-offline.css" rel="stylesheet">
                 <link href="styles/kendo.common.min.css" rel="stylesheet">
                 <link href="styles/kendo.default.min.css" rel="stylesheet">
                 <link href="css/my_buttons.css" rel="stylesheet">
   

		<script type="text/javascript" language="javascript" charset="utf-8" src="js/jquery.min.js"></script>
		<script type="text/javascript" language="javascript" charset="utf-8" src="js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" language="javascript" charset="utf-8" src="js/dataTables.tabletools.min.js"></script>
		<script type="text/javascript" language="javascript" charset="utf-8" src="js/dataTables.editor.min.js"></script>
		<script type="text/javascript" language="javascript" charset="utf-8" src="js/table.phones.js"></script>
                <script src="js/jquery.min.js"></script>
                <script src="js/kendo.web.min.js"></script>
                <script src="examples/content/shared/js/console.js"></script>
</head>

<body id="dt_example">
    
<div id="wrapper">

    <!--<h2>OSIS PBX</h2>-->
<?php include($_SERVER['DOCUMENT_ROOT']."/telrex/includes/header.php"); ?>
<?php include($_SERVER['DOCUMENT_ROOT']."/telrex/includes/mainmenu.php"); ?>

<div id="content">

<div id="container">
		<h3>Phones</h3>
			
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="phones" width="100%">
				<thead>
					<tr>
						<!--<th>Id</th>-->
						<th>Number</th>
						<!--<th>Auth</th>-->
						<th>DUser</th>
						<th>Callerid</th>
						<th>Type</th>
						<th>Context</th>
						<th>Host</th>
						<th>Secret</th>
						<th>Qualify</th>   
						<th>Nat</th>
						<th>Dmedia</th>
						<th>Dtmf</th>
						<th>VMail</th>                                             
					</tr>
				</thead>
			</table>

		</div>
<br></br>
<div id="saver">
<?php
/*if (isset ($_POST['save'])) { 
require_once('phpagi/phpagi-asmanager.php');
$asm = new AGI_AsteriskManager();
if($asm->connect("127.0.0.1", PHP_AGI_LOGIN, PHP_AGI_PASS))
{
	$asm->command("reload");
	$asm->disconnect();
}
}*/
?>
<!--<form action="php/aster_reload.php" method="post">
	<input type="submit" class="savebut" name="save" value="Save config">
</form>-->

</div>

</div> <!-- end #content -->


</div> <!-- end #content -->


<br></br>
<?php include($_SERVER['DOCUMENT_ROOT']."/telrex/includes/footer.php"); ?>


</div> <!-- End #wrapper -->

	</body>

</html>
