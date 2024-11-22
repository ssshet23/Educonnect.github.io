html>
<head>
        <title>PHP and MySQL</title>
</head>
<body>
<?php
        $con=mysqli_connect("localhost","root","");
        mysqli_select_db($con,"sales");
        if(mysqli_connect_error()){
                        printf("Connectfailed: %s",mysqli_connect_error());
                        exit();
        }
        else
                printf("Connection to Mysql successful!");
        
        
        $query="select * from cookie where saleamount>100";
        $result=mysqli_query($con,$query);
		$rowcount=mysqli_num_rows($result);
		while($row=mysqli_fetch_assoc($result))
		{
			echo "sale id=".$row['saleid']."<br>
			salename:".$row['salename']."<br>
			saleamt:".$row['saleamount']."<br>
		saledate:".$row['saledate']."<br><br>" ;}
		
		
			
			echo " no of rows affected " , $rowcount;
			?>
	</body>
</html>	
