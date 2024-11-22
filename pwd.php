<html>
<body>
<?php
$con=mysqli_connect("localhost","root","");
mysqli_select_db($con,"check");
if(mysqli_connect_errno())
	printf("%s failed" ,mysqli_connect_errno);
else
	printf("succesful");

$id1=$_POST['id'];
$pwd=$_POST['pwd'];
$hpwd=sha1($pwd);
$query="select * from data where id='$id1' ";
$res=mysqli_query($con,$query);
if(mysqli_error($con))
{
printf(mysqli_error($con));
}
else
{
		while($row=mysqli_fetch_assoc($res))
		{
		if($row['password']==$pwd)
		{
			printf("login correct");
		}
		else{
			printf("login failed");
		}
		}
}
mysqli_close($con);

?>
</body>
</html>