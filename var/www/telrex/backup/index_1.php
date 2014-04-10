<?php

require_once 'classes/Membership.php';
$membership = New Membership();

$membership->confirm_Member();

?>
<!DOCTYPE html>
<html>
<head>

    <title>OSIS PBX</title>

    <link href="examples/content/shared/styles/examples-offline.css" rel="stylesheet">
    <link href="styles/kendo.common.min.css" rel="stylesheet">
    <link href="styles/kendo.default.min.css" rel="stylesheet">
    <link href="css/my_tab_style.css" rel="stylesheet">
    
    <script src="js/jquery.min.js"></script>
    <script src="js/kendo.web.min.js"></script>
    <script src="examples/content/shared/js/console.js"></script>
</head>
<body>
    <h3>OSIS PBX</h3>
    
 <?php include($_SERVER['DOCUMENT_ROOT']."/osispbx/includes/mainmenu.php"); ?>
    <!-- class="k-content"-->
<div id="example" class="k-content">
        <div id="tabstrip" accesskey="w">
            <ul>
                <li class="k-state-active">
                    Users/Peers
                </li>
                <li>
                    Active Calls
                </li>
                <li>
                    System
                </li>
                <li>
                    Debug
                </li>
                
            </ul>
            <div>
                <div class="weather">
<?php
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
                <span class="rainy">&nbsp;</span>
            </div>
            <div>
                <div class="weather">                  
 <?php
require_once('phpagi/phpagi-asmanager.php');
$asm = new AGI_AsteriskManager();
if($asm->connect("127.0.0.1","phpagi","taiphoon123"))
{
    $peer = $asm->command("core show channels verbose");
    //print_r ($peer);
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
    $asm->disconnect();
}
?>
                </div>
                <span class="sunny">&nbsp;</span>
            </div>
            <div>
                <div class="weather">
                    
                    <p>System.</p>
                </div>
                <span class="sunny">&nbsp;</span>
            </div>
            <div>
                <div class="weather">
                    
                    <p>Debug.</p>
                </div>
                <span class="cloudy">&nbsp;</span>
            </div>
            
    </div>

 


 <!--   <style scoped>
     
        .sunny, .cloudy, .rainy {
            display: inline-block;
            margin: 20px 0 20px 10px;
            width: 128px;
            height: 428px;
            
        }

        .cloudy{
            background-position: -128px 0;
        }

        .rainy{
            background-position: -256px 0;
        }

        .weather {
            width: 660px;
            padding: 40px 0 0 0;
            float: left;
        }

        #keyboard-nav
        {
            padding-top: 35px;
        }
        
        
    /*  #tabstrip 
    {
        width: 320px;
        float: right;
        margin-bottom: 20px;
    }*/
    #tabstrip .k-content 
    {
    	height: 220px;
    	overflow: auto;
    }
 /*   .specification {
        max-width: 670px;
        margin: 10px 0;
        padding: 0;
    }
    .specification dt, dd {
        width: 140px;
        float: left;
        margin: 0;
        padding: 5px 0 7px 0;
        border-top: 1px solid rgba(0,0,0,0.3);
    }
    .specification dt {
        clear: left;
        width: 120px;
        margin-right: 7px;
        padding-right: 0;
        text-align: right;
        opacity: 0.7;
    }
    .specification:after, .wrapper:after {
        content: ".";
        display: block;
        clear: both;
        height: 0;
        visibility: hidden;*/
    </style>-->

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
     
 <?php include($_SERVER['DOCUMENT_ROOT']."/osispbx/includes/footer.php"); ?>
    
    
</body>
</html>
