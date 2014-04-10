<?php

require_once 'classes/Membership.php';
$membership = New Membership();

$membership->confirm_Member();

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
		<h3>Server configuration</h3>
<?php
 /*
$peers = shell_exec('./ifc.sh');
 echo $peers;
 echo '<br>';*/
/*$socket = fsockopen("127.0.0.1","5038", $errno, $errstr, 10);
      if (!$socket){
	echo "$errstr ($errno)\n";
	}else{
            fputs($socket, "Action: Login\r\n");
            fputs($socket, "UserName: admin\r\n");
            fputs($socket, "Secret: taiphoon123\r\n\r\n");

            fputs($socket, "Action: Command\r\n");
            //fputs($socket, "Command: sip reload\r\n\r\n");
 
//            fputs($socket, "Command: dialplan reload\r\n\r\n");
            fputs($socket, "Command: sip show peers\r\n\r\n");
            fputs($socket, "Action: Logoff\r\n\r\n");
            while (!feof($socket)){
               echo fgets($socket).'<br>';
            }
            fclose($socket);
            }*/
require_once('phpagi/phpagi-asmanager.php');
$asm = new AGI_AsteriskManager();
if($asm->connect("127.0.0.1","phpagi","taiphoon123"))
{
    $peer = $asm->command("sip show peers");
    //print_r ($peer);
    /*foreach ($peer as $p=>$p_value) {
        echo $p . " " . $p_value;
        echo "<br>";
    }*/
    /*if(!strpos($peer['data'], ':'))
      echo $peer['data'];
     else
    {*/
      $data = array();
      foreach(explode("\n", $peer['data']) as $line)
      {
        $a = strpos('z'.$line, ' ') - 1;
        if($a >= 0) $data[trim(substr($line, 0, $a))] = trim(substr($line, $a + 1));
      }
      //print_r($data);
      
      foreach ($data as $p=>$p_value) {
        echo $p . " " . " " . $p_value;
        echo "<br>";
      }
      echo "<br>";
      //print_r($peer);
    //}
    
    $asm->disconnect();
}
?>

		</div>


</div> <!-- end #content -->



<?php include($_SERVER['DOCUMENT_ROOT']."/telrex/includes/footer.php"); ?>


</div> <!-- End #wrapper -->

	</body>

</html>
