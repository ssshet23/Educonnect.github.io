<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password_hash"];

    // Hash the password
    $hashed_password = sha1($password);

    // Connect to the database
    try {
        $con = mysqli_connect("localhost", "root", "", "educonnect");
        
        if (mysqli_connect_error()) {
            printf("Connection failed: %s\n", mysqli_connect_error());
            exit();
        }

        // Check if the user exists
        $query = "SELECT * FROM users1 WHERE username='$username' AND password='$hashed_password'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) == 1) {
            // User exists, redirect to homepage
            header("Location: http://localhost/main1.html");
            exit();
        } else {
            echo "<script>alert('Invalid username or password!');</script>";
            echo "<script>window.history.go(-1);</script>";
            
            exit();
        }
        
    } catch(Exception $e) {
        echo "Error: " . $e->getMessage();
    }

    mysqli_close($con);
}
?>
































/*$con = mysqli_connect("localhost", "root", "", "educonnect");
if (mysqli_connect_errno()) {
    printf("Connection failed: %s\n", mysqli_connect_error());
    exit();
}
printf("connection success");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $pwd = $_POST['password_hash'];  // SHA-1 hashing
    $hashed_password=sha1($pwd);
    $stmt = mysqli_prepare($con, "SELECT * FROM users1 WHERE email = '$email' AND password_hash='$hashed_password' ");
    if ($stmt === false) {
        printf("MySQL prepare error: %s\n", mysqli_error($con));
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $hashed_password);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        mysqli_stmt_fetch($stmt);
        if ($pwd === $hashed_password) 
    
            printf("Login correct");
        } else {
            printf("Login failed");
        }
    } else {
        printf("No such user found.");
    }
    mysqli_stmt_close($stmt);

mysqli_close($con);
?>

*/