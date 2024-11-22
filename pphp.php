<html>
<head>
        <title>PHP and MySQL</title>
</head>
<style>
table{ 
	width:75%;
	border-collapse:collapse;
	}
td,th{
		border:2px solid black;
		}
		</style>
<?php
        $con=mysqli_connect("localhost","root","");
        mysqli_select_db($con,"sales");
        if(mysqli_connect_error()){
                        printf("Connectfailed: %s",mysqli_connect_error());
                        exit();
        }
        else
                printf("Connection to Mysql successful!");
        
        
        $query="select * from cookie";
        $result=mysqli_query($con,$query);
        if(mysqli_error($con)){
                print(mysqli_error($con));
        }

        else
        {
                echo" sales details are<br>";
				echo"<table><tr><th>saleid</th>
				<th>salename</th>
				<th>saleamount</th>
				<th>saledate</th></tr>";
				while($row=mysqli_fetch_assoc($result))
				{
				echo"<tr><td>".$row['saleid'].
					"</td><td>".$row['salename']."</td><td>"
					.$row['saleamount']."</td><td>"
					.$row['saledate']."<td></tr>";
					
        }
		echo"</table>";
        }
        
?>
</body></html>