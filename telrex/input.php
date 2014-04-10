<?php

require_once 'classes/Membership.php';
$membership = New Membership();

$membership->confirm_Member();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.sergibondarenko.com/2012/xhtml">

<html xmlns="http://www.sergibondarenko.com/2012/xhtml" xml:lang="en" lang="en">

<head>

<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		
		<title>IVR</title>

		
		<link href="css/jquery.dataTables.css" rel="stylesheet">
                 <link href="css/dataTables.tabletools.css" rel="stylesheet"> 
                 <link href="css/dataTables.editor.css" rel="stylesheet">
                 <link href="examples/content/shared/styles/examples-offline.css" rel="stylesheet">
                 <link href="styles/kendo.common.min.css" rel="stylesheet">
                 <link href="styles/kendo.default.min.css" rel="stylesheet">
    
   

		<script type="text/javascript" language="javascript" charset="utf-8" src="js/jquery.min.js"></script>
		<script type="text/javascript" language="javascript" charset="utf-8" src="js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" language="javascript" charset="utf-8" src="js/dataTables.tabletools.min.js"></script>
		<script type="text/javascript" language="javascript" charset="utf-8" src="js/dataTables.editor.min.js"></script>
		<script type="text/javascript" language="javascript" charset="utf-8" src="js/table.input.js"></script>
                <script src="js/jquery.min.js"></script>
                <script src="js/kendo.web.min.js"></script>
                <script src="examples/content/shared/js/console.js"></script>
</head>

<body id="dt_example">
    
<div id="wrapper">


<?php include($_SERVER['DOCUMENT_ROOT']."/telrex/includes/header.php"); ?>
<?php include($_SERVER['DOCUMENT_ROOT']."/telrex/includes/mainmenu.php"); ?>

<div id="content">

<div id="container">
		<h3>IVR</h3>
			
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="input" width="100%">
				<thead>
					<tr>
						<th>Type</th>
                                                <th>Incomming Num</th>
						<th>Sound</th>
						<th>Button</th>
						<th>Queue/ext</th>
						<th>Button</th>
						<th>Queue/ext</th>
						<th>Button</th>
						<th>Queue/ext</th>
						<th>Button</th>
						<th>Queue/ext</th>
						<th>Button</th>
						<th>Queue/ext</th>
                                                
                                                
						
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




<?php include($_SERVER['DOCUMENT_ROOT']."/telrex/includes/footer.php"); ?>


</div> <!-- End #wrapper -->

	</body>

</html>




