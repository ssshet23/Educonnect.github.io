<html>
<head><title>SignUp PHP</title>
</head>
<body>
<?php
$con=mysqli_connect("localhost","root","","educonnect");
if(mysqli_connect_errno()){
	printf("Connection failed:%s",mysqli_connect_errno());
	exit();
}
else{
$email=$_POST['email'];
$passwd=$_POST['password_hash'];
$passwd1=sha1($passwd);
$query="INSERT INTO users1 values('$email','$passwd1')";
mysqli_query($con,$query);
if(mysqli_error($con)){
		print(mysqli_error($con));
	}
	else{
        echo "<script>alert('Registration is successfull!!')</script>";
		header("Location: http://localhost/main1.html");
		
        
	}
	
}
?>
</body>
</html>