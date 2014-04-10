<?php

require_once 'classes/Membership.php';
$membership = New Membership();
$membership->confirm_Member();

session_start();
$_SESSION['redirect_url'] = $_SERVER['PHP_SELF'];
?>
<!DOCTYPE html>
<html>
<head>

    <title>Stella PBX</title>

    <link href="css/jquery.dataTables.css" rel="stylesheet">
                 <link href="css/dataTables.tabletools.css" rel="stylesheet"> 
                 <link href="css/dataTables.editor.css" rel="stylesheet">
                 <link href="examples/content/shared/styles/examples-offline.css" rel="stylesheet">
                 <link href="styles/kendo.common.min.css" rel="stylesheet">
                 <link href="styles/kendo.default.min.css" rel="stylesheet">
                 <link href="css/my_tab_style_noscroll.css" rel="stylesheet">
                 <link href="css/my_buttons.css" rel="stylesheet">
                 

		<script type="text/javascript" language="javascript" charset="utf-8" src="js/jquery.min.js"></script>
		<script type="text/javascript" language="javascript" charset="utf-8" src="js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" language="javascript" charset="utf-8" src="js/dataTables.tabletools.min.js"></script>
		<script type="text/javascript" language="javascript" charset="utf-8" src="js/dataTables.editor.min.js"></script>

		<script type="text/javascript" language="javascript" charset="utf-8" src="js/table.queues.js"></script>
		<script type="text/javascript" language="javascript" charset="utf-8" src="js/table.queuemember.js"></script>
          
                <script src="js/jquery.min.js"></script>
                <script src="js/kendo.web.min.js"></script>
                <script src="examples/content/shared/js/console.js"></script>

</head>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT']."/telrex/includes/header.php"); ?>
    
<?php include($_SERVER['DOCUMENT_ROOT']."/telrex/includes/mainmenu.php"); ?>

<div id="content">

<div id="example" class="k-content">
       <div id="tabstrip">
            <ul>
               <li class="k-state-active">
                    ACD Queues
                </li>
                <li>
                    Queue Members
                </li>
                <!--<li>
                    Queue Members
                </li>-->
               <!-- <li>
                    Debug
                </li>-->
                
            </ul>
            <div>
                <div class="weather">
 
 <div id="cont_queues"> <!-- CC Queues -->
			
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="queues" width="1180">
				<thead>
					<tr>
						<th>Name</th>
						<th>Musiconhold</th>
						<!--<th>Member Announce</th>-->
						<th>Announce Freq</th>
						<th>Context</th>
						<th>Timeout</th>
						<th>Maxlen</th>
						
					</tr>
				</thead>
			</table>

</div>
 
                     <br></br>

                </div>
                <span class="rainy">&nbsp;</span>
            </div>
            <div>
                <div class="weather">   

<div id="cont_queuemembers">  <!-- Queue Members -->
		
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="queuemember" width="1180">
				<thead>
					<tr>
						<th>Uniqueid</th>
						<th>Membername</th>
						<th>Queue Name</th>
						<th>Interface</th>
						<th>Penalty</th>
						<th>Paused</th>
				
						
					</tr>
				</thead>
			</table>

</div>

                    <br></br>
  
                    
                </div>
                <span class="sunny">&nbsp;</span>
            </div>
            <div>
                <div id ="sytemc" class="weather">

                    <br></br>
<!--<div id="saver">
<form action="php/aster_reload.php" method="post">
	<input type="submit" class="savebut" name="save" value="Save config">
</form>
</div>-->    
                    <p></p>
                      </div>
                <span class="sunny">&nbsp;</span>
            </div>
         </div>
    <script>
        $(document).ready(function() {
            $("#tabstrip").kendoTabStrip({
                animation:	{
                    open: {
                        effects: "fadeIn"
                    }
                }
            });
        });
    </script>
</div>
     <div>
         </div>
    

</div> <!-- end #content -->    
    
<?php include($_SERVER['DOCUMENT_ROOT']."/telrex/includes/footer.php"); ?>
    
    
</body>
</html>
