<!DOCTYPE html>
<html>
 <head>
    <script src="js/jquery.min.js"></script>
<script src="js/kendo.web.min.js"></script>
<script src="examples/content/shared/js/console.js"></script>

<script>
    $(document).ready(function(){$("#menu").kendoMenu();});
</script>
</head>

<?php

?>
<ul id="menu"  accesskey="w">
         <li>
                <a href="/telrex/index.php">Home</a>
         </li>
         <li >
                <a href="#">System</a>
                <ul>
                        <li disabled="disabled"><a href="#">About</a></li>
                        <!--<li disabled="disabled"><a href="#">Server Configuration</a></li>-->
                        <li><a href="/telrex/filegator/index.php">File Manager</a></li>
                        <li><a href="/telrex/users.php">Admins</a></li>
                </ul>
        </li>
        <li>
                <a href="#">Configuration</a>
                <ul>
                        <li><a href="/telrex/phonestrunks.php">Phones and Trunks</a></li>
                        <li><a href="/telrex/dialplan.php">Dial Plan</a></li>
                        <li><a href="/telrex/uservoicemails.php">Voicemails</a></li>
                        <li><a href="/telrex/musiconhold.php">Music on Hold</a></li>
                        <!--<li><a href="/telrex/groups.php">Groups Config</a></li>-->
                        <!--<li disabled="disabled"><a href="#">Queues</a></li>-->
                        <!--<li><a href="/telrex/input.php">IVR</a></li>-->
                        
                </ul>
        </li>
        <li>
                <a href="#">ACD</a>
                <ul>
                        <li><a href="/telrex/acdconfig.php">Configuration</a></li>
                        <li><a href="/telrex/acdcdr.php">Statistic</a></li>
                        <!--<li><a href="/telrex/uservoicemails.php">Voicemails</a></li>
                        <li><a href="/telrex/musiconhold.php">Music on Hold</a></li>-->
                        <!--<li><a href="/telrex/groups.php">Groups Config</a></li>-->
                        <!--<li disabled="disabled"><a href="#">Queues</a></li>-->
                        <!--<li><a href="/telrex/input.php">IVR</a></li>-->
                        
                </ul>
        </li>
               
                <li><a href="/telrex/cdr.php">CDR</a></li>
        <li disabled="disabled"><a href="#">Help</a></li>
        <li><a href="login.php?status=loggedout">Log out</a></li>
        
        
</ul>
<!--
<ul id="menu" accesskey="w">
                    <li>
                        Projects
                        <ul>
                            <li>New Business Plan</li>
                            <li>
                                Sales Forecasts
                                <ul>
                                    <li>Q1 Forecast</li>
                                    <li>Q2 Forecast</li>
                                    <li>Q3 Forecast</li>
                                    <li>Q4 Forecast</li>
                                </ul>
                            </li>
                            <li>Sales Reports</li>
                        </ul>

                    </li>
                    <li>
                        Programs
                        <ul>
                            <li>Monday</li>
                            <li>Tuesday</li>
                            <li>Wednesday</li>
                            <li>Thursday</li>
                            <li>Friday</li>
                        </ul>
                    </li>
                    <li disabled="disabled">
                        Communication
                    </li>
                </ul>
            </div>-->

</body>
</html>
