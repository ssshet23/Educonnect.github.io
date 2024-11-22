?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $clg_id = $_POST['clg_id'];
    $college_type = $_POST['college_type'];
    $user_name = $_POST['user_name'];
    $review = $_POST['review'];

    // Establish connection to the database
    $con = mysqli_connect("localhost", "root", "", "educonnect");

    // Check connection
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }

    // Insert the review into the reviews table
    $query = "INSERT INTO reviews (clg_id, college_type, review, user_name) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "isss", $clg_id, $college_type, $review, $user_name);
    if (mysqli_stmt_execute($stmt)) {
        echo "Review submitted successfully!";
    } else {
        echo "Error: " . mysqli_error($con);
    }

    // Close the statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($con);

    // Redirect back to the college details page
    header("Location: college_details.php?clg_id=$clg_id&college_type=$college_type");
    exit();
}
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $clg_id = $_POST['clg_id'];
    $college_type = $_POST['college_type'];
    $user_name = $_POST['user_name'];
    $review = $_POST['review'];

    // Establish connection to the database
    $con = mysqli_connect("localhost", "root", "", "educonnect");

    // Check connection
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }

    // SQL query to insert the review
    $query = "INSERT INTO reviews (clg_id, college_type, user_name, review) VALUES ('$clg_id', '$college_type', '$user_name', '$review')";
    if (mysqli_query($con, $query)) {
        echo "Review submitted successfully!";
    } else {
        echo "Error: " . mysqli_error($con);
    }

    // Close the database connection
    mysqli_close($con);

    // Redirect back to the college details page
    header("Location: college_details.php?clg_id=$clg_id&college_type=$college_type");
    exit();
} else {
    echo "Invalid request.";
}
?>
