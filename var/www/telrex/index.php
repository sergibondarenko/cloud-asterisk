<?php
//hello hello Sergey
require_once 'classes/Membership.php';
$membership = New Membership();

$membership->confirm_Member();

?>
<!DOCTYPE html>
<html>
<head>

    <title>TelREX</title>

    <link href="examples/content/shared/styles/examples-offline.css" rel="stylesheet">
    <link href="styles/kendo.common.min.css" rel="stylesheet">
    <link href="styles/kendo.default.min.css" rel="stylesheet">
    <link href="css/my_tab_style.css" rel="stylesheet">
    <link href="css/my_buttons.css" rel="stylesheet">
    
    <script src="js/jquery.min.js"></script>
    <script src="js/kendo.web.min.js"></script>
    <script src="examples/content/shared/js/console.js"></script>
</head>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT']."/telrex/includes/header.php"); ?>
    
 <?php include($_SERVER['DOCUMENT_ROOT']."/telrex/includes/mainmenu.php"); ?>
    <!-- class="k-content"-->
<div id="example" class="k-content">
        <div id="tabstrip" accesskey="w">
            <ul>
                <li class="k-state-active">
                    Active Calls
                    
                </li>
                <li>
                    Active Users/Peers
                </li>
                <li>
                    System Info
                </li>
               <!-- <li>
                    Debug
                </li>-->
                
            </ul>
            <div>
                <div class="weather">
                <FORM>
                <INPUT TYPE="button" class="savebut" onClick="window.location.reload()" VALUE="Refresh this Info">
                </FORM>
                    <br>
                <?php include($_SERVER['DOCUMENT_ROOT']."/telrex/astsyscom/core_show_channels_verbose.php"); ?>
                               
                </div>
                <span class="rainy">&nbsp;</span>
            </div>
            <div>
                <div class="weather">   
                <?php include($_SERVER['DOCUMENT_ROOT']."/telrex/astsyscom/sip_show_peers.php"); ?> 
                    
                </div>
                <span class="sunny">&nbsp;</span>
            </div>
            <div>
                <div id ="sytemc" class="weather">
                    
                    
                <?php include($_SERVER['DOCUMENT_ROOT']."/telrex/astsyscom/core_sh_sysinfo.php"); ?>
               
                <?php include($_SERVER['DOCUMENT_ROOT']."/telrex/astsyscom/core_sh_settings.php"); ?>    
                    <p></p>
<!-- <?php
/*if (isset ($_POST['shup'])) { 
        //shell_exec("/var/osistelephony/ConfigsCC/make.sh");
        include 'astsyscom/core_sh_uptime.php';
}*/
?>
<form action="" method="post">
<input type="submit" name="shup" value="Show Uptime">
</form>

<script langauge="javascript">
function clear(elementID)
{
 //   $("#cart_item").html("");
document.getElementById(elementID).innerHTML = "";
}
</script>
<button onclick="clear('systemc')">Clear Screen</button>
     -->           
                </div>
                <span class="sunny">&nbsp;</span>
            </div>
<!--            <div>
                <div class="weather">
                    
                    <p>Debug.</p>
                </div>
                <span class="cloudy">&nbsp;</span>
            </div>-->
            
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
     
 <?php include($_SERVER['DOCUMENT_ROOT']."/telrex/includes/footer.php"); ?>
    
    
</body>
</html>
