<?php

require_once 'classes/Membership.php';
$membership = New Membership();

$membership->confirm_Member();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.sergibondarenko.com/2012/xhtml">

<html xmlns="http://www.sergibondarenko.com/2012/xhtml" xml:lang="en" lang="en">

<head>
<meta charset="utf-8"></meta>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		
		<title>Upload IVR Sounds</title>

		
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
		
                <script src="js/jquery.min.js"></script>
                <script src="js/kendo.web.min.js"></script>
                <script src="examples/content/shared/js/console.js"></script>
                              
</head>

<body id="dt_example">
    
<div id="wrapper">


<h3>OSIS PBX</h3>
<?php include($_SERVER['DOCUMENT_ROOT']."/telrex/includes/mainmenu.php"); ?>

<div id="content">
  
<div id="container">
	<h3>Upload IVR Sounds</h3>

<form action="upload_sound.php" method="post"
enctype="multipart/form-data">
    <label for="file">Filename:</label>
    <input class="sgreenbut" type="file" name="file" id="file" ><br></br>
    <input type="submit" class="savebut" name="submit" value="then Upload">
</form>
     
                
<?php
$uploaddir="/var/soundsCC/";

if ($_FILES["file"]["error"] > 0)
  {
  echo "Error: " . $_FILES["file"]["error"] . "<br>";
  }
else
  {
  echo "Upload: " . $_FILES["file"]["name"] . "<br>";
  echo "Type: " . $_FILES["file"]["type"] . "<br>";
  echo "Size: " . (round($_FILES["file"]["size"] / 1000024)) . " MB<br>";
  echo "Stored in: " . $_FILES["file"]["tmp_name"];
  
    if (file_exists($uploaddir . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      $uploaddir . $_FILES["file"]["name"]);
      echo "Stored in: " . $uploaddir . $_FILES["file"]["name"];
      
      shell_exec("/var/soundsCC_tmp/convert.sh /var/soundsCC/".$_FILES["file"]["name"]);
      }
  
  }
  
  
?>
</div>

<!--<div id="convertsound"> 
<?php/*
if (isset ($_POST['convert'])) { 
        shell_exec("/var/soundsCC_tmp/convert.sh");
}*/
?>
<form action="" method="post">
<input type="submit" name="convert" value="Convert to proper format">
</form>
</div>
    -->    

<br></br>

<form name="delete" action="<?=$PHP_SELF?>" method="POST" enctype="multipart/form-data">  
<input type="hidden" name="id" value="<?=$_GET['id'] ?>" />  
For removing press "delete" below!!! <br>Then are you sure you wish to delete "<?echo $_GET['id'];?>" ?  
<input type="submit" class="redbut" name="doaction" value="YES" />  
</form>  
    
        
<?php  
$filedir="/var/soundsCC/";

if ($_POST['doaction'])  
{  
    $file = $_POST['id'];  
    if (file_exists($filedir.$file))  
    {  
        unlink($filedir.$file); 
        echo "Deleted '$file'";  
        echo "<br><br><a href=upload_sound.php>Return back</a>"; 
    }  
    else  
    {  
        echo "The file '$file' does not exist.";  
    }    
} 
else //if no $_GET['action'] (the page will default to this) 
{ 

if ($handle = opendir($filedir)) { 
   while (false !== ($file = readdir($handle))) { 
          //if ($file != "." && $file != ".." && $file != ".htaccess" && $file != "test.php" && $file != "del.php" && is_file($file)) { 
          if ($file != '.' && $file != '..' && $file != '*') {          
              $list .= '<a href="'.$file.'">'.$file.'</a> - <font size="2"><a href="upload_sound.php?action=delete&id='.$file.'">[delete]</a></font><br><br>'; 
          } 
       } 
  closedir($handle); 
  } 
  else  echo 'There was problem opening '+ $filedir;

echo $list; 

} 

?>  


</div> <!-- end #content -->

<br>
<?php include($_SERVER['DOCUMENT_ROOT']."/telrex/includes/footer.php"); ?>


</div> <!-- End #wrapper -->

	</body>

</html>
