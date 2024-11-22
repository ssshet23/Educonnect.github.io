<?php
// Establish connection to the database
$con = mysqli_connect("localhost", "root", "", "educonnect");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Retrieve form data
$clg_id = $_POST['clg_id'];
$college_type = $_POST['college_type'];
$user_name = $_POST['user_name'];
$review = $_POST['review'];

// Insert review into the reviews table
$query = "INSERT INTO reviews (clg_id, college_type, review, user_name) VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "isss", $clg_id, $college_type, $review, $user_name);
mysqli_stmt_execute($stmt);

// Close the database connection
mysqli_close($con);

// Redirect back to the college details page
header("Location: " . $_SERVER['HTTP_REFERER']);
exit();
?>
