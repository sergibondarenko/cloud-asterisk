<?php

require_once 'classes/Membership.php';
$membership = New Membership();

$membership->confirm_Member();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.sergibondarenko.com/2012/xhtml">

<html xmlns="http://www.sergibondarenko.com/2012/xhtml" xml:lang="en" lang="en">

<head>

<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		
<title>Routing</title>

		<style type="text/css">
			@import "css/demo_page.css";
			@import "css/jquery.dataTables.css";
			@import "css/dataTables.tabletools.css";
			@import "css/dataTables.editor.css";
			@import "css/menustyle.css";
		</style>

		<script type="text/javascript" language="javascript" charset="utf-8" src="js/jquery.min.js"></script>
		<script type="text/javascript" language="javascript" charset="utf-8" src="js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" language="javascript" charset="utf-8" src="js/dataTables.tabletools.min.js"></script>
		<script type="text/javascript" language="javascript" charset="utf-8" src="js/dataTables.editor.min.js"></script>
		<script type="text/javascript" language="javascript" charset="utf-8" src="js/table.routing.js"></script>
</head>

<body id="dt_example">
    
<div id="wrapper">

<?php include($_SERVER['DOCUMENT_ROOT']."/asterweb/includes/header.php"); ?>
<?php include($_SERVER['DOCUMENT_ROOT']."/asterweb/includes/nav.php"); ?>

<div id="content">

<div id="container">
			<h1>
				Routing
			</h1>
			
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="routing" width="100%">
				<thead>
					<tr>
						<th>channel</th>
						<th>context</th>
						<th>dial plan</th>
						<th>trunk</th>
					</tr>
				</thead>
			</table>

		</div>
<div id="saver">
<?php
if (isset ($_POST['save'])) { 
        shell_exec("/var/osistelephony/ConfigsCC/make.sh");
}
?>
<form action="" method="post">
<input type="submit" name="save" value="Save config">
</form>
</div>

</div> <!-- end #content -->



<?php include($_SERVER['DOCUMENT_ROOT']."/asterweb/includes/footer.php"); ?>


</div> <!-- End #wrapper -->

	</body>

</html>
