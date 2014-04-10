<?php



/*$str = 'taiphoon8505';
echo md5($str);
echo '<br>';*/

session_start();
$redirect_url = $_SESSION['redirect_url'];
header("location: $redirect_url");
echo $_SESSION['redirect_url'];

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

//echo $encrPassword;

//$result = mysqli_query($con,"SELECT * FROM users");
/*$maxID = mysqli_query($con,"SELECT MAX(id) FROM users;");
if(! $maxID )
{
  die('Could not update data: ' . mysql_error());
}
echo "Updated data successfully\n";
$row = mysqli_fetch_array($maxID);
printf ($raw);*/
/*$result = mysqli_query($con,"SELECT * FROM users WHERE id=". $maxID ."");

while($row = mysqli_fetch_array($result))
  {
  $encrPassword = md5($row['password']);
  }

$updateQuery = 'UPDATE users
        SET password='. "\"". $encrPassword ."\"" .'
        WHERE id='. $maxID .'';

$retval = mysqli_query($con, $updateQuery);
//echo $retval . '<br>';
if(! $retval )
{
  die('Could not update data: ' . mysql_error());
}
echo "Updated data successfully\n";
*/
mysqli_close($con);

?>