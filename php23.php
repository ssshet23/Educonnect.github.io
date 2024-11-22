<html>
<head>
<title> sql </title>
</head>
<?php 
$con=mysqli_connect("localhost","root","");
mysqli_select_db($con,"educonnect");
if(mysqli_connect_error())
{
	printf("connection failed %s",mysqli_connect_error());
	exit();
}
else
	printf("successful");

$email=$_GET['email'];
$pwd=$_GET['password_hash'];
//$pwd=sha1['pwd'];
$query="INSERT INTO users VALUES ('$email','$pwd')";
mysqli_query($con,$query);
if(mysqli_error($con))
{
	print(mysqli_error($con));
}
else
	print($name."succesfullyy ");
mysqli_close($con);
?>
</body>
</html>