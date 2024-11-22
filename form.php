<html>
<head>
<title> sql </title>
</head>
<?php 
$con=mysqli_connect("localhost","root","");
mysqli_select_db($con,"check");
if(mysqli_connect_error())
{
	printf("connection failed %s",mysqli_connect_error());
	exit();
}
else
	printf("successful");

$name=$_POST['name'];
$beauty=$_POST['num1'];
$gf=$_POST['num2'];
$word=$_POST['word'];
$like1=$_POST['like'];
$msg=$_POST['msg'];
$query="INSERT INTO shivani VALUES ('$name','$beauty','$gf','$word','$like1','$msg')";
mysqli_query($con,$query);
if(mysqli_error($con))
{
	print(mysqli_error($con));
}
else
	print($name."succesfullyy completed");
mysqli_close($con);
?>
</body>
</html>