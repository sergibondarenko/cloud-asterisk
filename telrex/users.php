<?php

require_once 'classes/Membership.php';
$membership = New Membership();

$membership->confirm_Member();

?>
<?php
if (!empty($_POST['save'])) {
	
	require_once 'includes/constants.php';
	
	$con=mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
	
	// Check connection
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  } else {
	      //echo "Success!";
		  //echo '<br>';
	  }
	
	$result = mysqli_query($con,"SELECT * FROM users");
	while($row = mysqli_fetch_array($result))
	{
		if( !preg_match('/^[a-f0-9]{32}$/', $row['password']) ){
			$encrPassword = md5($row['password']);
			$retval = mysqli_query($con, "UPDATE users SET password="."\"".$encrPassword."\""." WHERE id=".$row['id']."");
			if(! $retval ){
				die('Could not update data: ' . mysql_error());
			}
		} 
	}

	mysqli_close($con);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.sergibondarenko.com/2012/xhtml">

<html xmlns="http://www.sergibondarenko.com/2012/xhtml" xml:lang="en" lang="en">

<head>

<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		
		<title>Admins</title>

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
		<script type="text/javascript" language="javascript" charset="utf-8" src="js/table.users.js"></script>
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
		<h3>Admins</h3>
			
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="users" width="100%">
				<thead>
					<tr>
						<th>Username</th>
						<th>Password</th>
						<!--<th>Permissions</th>
						<th>Homedir</th>-->
					</tr>
				</thead>
			</table>

		</div>


</div> <!-- end #content -->
<br></br>
<div id="saver">
<form action="users.php" method="post">
	<input type="submit" class="savebut" name="save" value="Save passwords">
</form>
</div>

<br></br>
<?php include($_SERVER['DOCUMENT_ROOT']."/telrex/includes/footer.php"); ?>


</div> <!-- End #wrapper -->

	</body>

</html>
