<?php

require_once 'classes/Membership.php';
$membership = New Membership();

$membership->confirm_Member();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.sergibondarenko.com/2012/xhtml">

<html xmlns="http://www.sergibondarenko.com/2012/xhtml" xml:lang="en" lang="en">

<head>

<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		
		<title>CDR</title>

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
		<script type="text/javascript" language="javascript" charset="utf-8" src="js/table.acdcdr.js"></script>
                <script src="js/jquery.min.js"></script>
                <script src="js/kendo.web.min.js"></script>
                <script src="examples/content/shared/js/console.js"></script>
                <!--<script type="text/javascript" charset="utf-8" src="extras/TableTools/media/js/ZeroClipboard.js"></script>
                <script type="text/javascript" charset="utf-8" src="extras/TableTools/media/js/TableTools.js"></script>>
                -->
                </head>

<body id="dt_example">
    
<div id="wrapper">

<?php include($_SERVER['DOCUMENT_ROOT']."/telrex/includes/header.php"); ?>
<?php include($_SERVER['DOCUMENT_ROOT']."/telrex/includes/mainmenu.php"); ?>

<div id="content">

<div id="container">
		<h3>CDR</h3>

                
<!--<?
/*** process asterisk cdr file (Master.csv) insert usage
 * values into a mysql database which is created for use
 * with the Asterisk_addons cdr_addon_mysql.so
 * The script will only insert NEW records so it is safe
 * to run on the same log over-and-over such as in the
 * case where logs have not been rotated.
 *
 * Author: John Lange (john.lange@open-it.ca)
 * Date: May 4, 2005. Updated July 21, 2005
 *
 * Here is what the script does:
 *
 * 1) Find the last log entry in the database cdr table.
 * 2) scan the asterisk logs until the dates are larger than the last log entry (so we don't duplicate entries)
 * 3) parse each row from the text log and insert it into the database.
 * 
 */
/*
$locale_db_host  = 'localhost';
$locale_db_name  = 'asterisk';
$locale_db_login = 'root';
$locale_db_pass  = 'taiphoon';

if($argc == 2) {
    $logfile = $argv[1];
} else {
    print("Usage ".$argv[0]."/var/log/asterisk/cdr-csv/Master.csv");
    print("Where filename is the path to the Asterisk csv file to import (Master.csv)\n");
    print("This script is safe to run multiple times on a growing log file as it only imports records that are newer than the database\n");
    exit(0);
}

// connect to db
$linkmb = mysql_connect($locale_db_host, $locale_db_login, $locale_db_pass)
       or die("Could not connect : " . mysql_error());
//echo "Connected successfully\n";
mysql_select_db($locale_db_name, $linkmb) or die("Could not select database $locale_db_name");

/** 1) Find the last log entry **/
// look in cdr table to see when the last entry was made.
// this establishes the starting point for the asterisk data.
/*$sql="SELECT UNIX_TIMESTAMP(calldate) as calldate".
    "  FROM cdr".
    " ORDER BY calldate DESC".
    " LIMIT 1";

if(!($result = mysql_query($sql, $linkmb))) {
    print("Invalid query: " . mysql_error()."\n");
    print("SQL: $sql\n");
    die();
}
$result_array = mysql_fetch_array($result);
//$lasttimestamp = date("Y-m-d H:i:s", $result_array['voip_stamp']);
$lasttimestamp = $result_array['calldate'];

//** 2) Find new records in the asterisk log file. **

$rows = 0;
$handle = fopen($logfile, "r");
while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    // NOTE: the fields in Master.csv can vary. This should work by default on all installations but you may have to edit the next line to match your configuration
    list($accountcode,$src, $dst, $dcontext, $clid, $channel, $dstchannel, $lastapp, $lastdata, $start, $answer, $end, $duration,
     $billsec, $disposition, $amaflags ) = $data;
    
    // 3) parse each row and add to the database
    if(strtotime($end) > $lasttimestamp) { // we found a new record so add it to the DB
        $sql = "INSERT INTO cdr (calldate, clid, src, dst, dcontext, channel, dstchannel, lastapp, lastdata, duration, billsec, disposition, amaflags, accountcode)
                   VALUES('$end', '".mysql_real_escape_string($clid)."', '$src', '$dst', '$dcontext', '$channel', '$dstchannel', '$lastapp', '$lastdata', '$duration', '$billsec',
                    '$disposition', '$amaflags', '$accountcode')";
        if(!($result2 = mysql_query($sql, $linkmb))) {
            print("Invalid query: " . mysql_error()."\n");
            print("SQL: $sql\n");
            die();
        }
        $rows++;
    }
}
fclose($handle);

print("$rows imported\n");*/
?>   -->             
                <table cellpadding="0" cellspacing="0" border="0" class="display" id="acdcdr" width="100%">
				<thead>
					<tr>
						<th>Time</th>
						<th>Callid</th>
						<th>Queuename</th>
						<th>Agent</th>
						<th>Event</th>
						<th>Data1</th>
						<th>Data2</th>
						<th>Data3</th>
						<th>Data4</th>
						<th>Data5</th>
						<!--<th>Billsec</th>
						<th>Disposition</th>
						<th>Amaflags</th>
						<th>Accountcode</th>
						<th>Uniqueid</th>
						<th>Userfield</th>-->
                                                
					</tr>
				</thead>
			</table>


<!--<?php
/*echo "<html><body><table>\n\n";
$f = fopen("/var/log/asterisk/cdr-csv/Master.csv", "r");
while (($line = fgetcsv($f)) !== false) {
        echo "<tr>";
        foreach ($line as $cell) {
                echo "<td>" . htmlspecialchars($cell) . "</td>";
        }
        echo "<tr>\n";
}
fclose($f);
echo "\n</table></body></html>";*/
?>	-->	

		</div>

</div> <!-- end #content -->


<br>
<?php include($_SERVER['DOCUMENT_ROOT']."/telrex/includes/footer.php"); ?>


</div> <!-- End #wrapper -->

	</body>

</html>
