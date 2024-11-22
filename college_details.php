<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Colleges</title>
<style>
    body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: url('background.jpg') no-repeat center center fixed;
    background-size: cover;
    color: #333;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
   min-height: 100vh;
}

h1 {
    text-align: center;
    color: #007bff;
    margin: 40px 0;
    font-size: 2.5rem;
    font-weight: bold;
}

.container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    max-width: 1200px;
    width: 100%;
    padding: 20px;
}

.card {
    background-color: rgba(255, 255, 255, 0.95);
    border: 1px solid #007bff;
    border-radius: 10px;
    padding: 20px;
    margin: 20px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 800px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
}

.card h2 {
    margin-top: 0;
    color: #007bff;
    font-size: 1.8rem;
    text-align: center;
}

.card img {
    display: block;
    margin: 0 auto; /* Center the image */
    max-width: 100%;
    height: auto;
    border-radius: 10px;
    cursor: pointer;
    transition: transform 0.3s ease;
}

.card img:hover {
    transform: scale(1.05);
}

.card-content {
    width: 100%;
    text-align: left;
}

.card-content p {
    margin: 10px 0;
}
.card-content button {
    background-color: #007bff;
    border: none;
    color: white;
    padding: 10px 20px;
    text-align: center;
    font-size: 1rem;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s ease, transform 0.3s ease;
    margin-top: 10px;
}
.card-content button:hover {
    background-color: #0056b3;
    transform: translateY(-2px);
}

.card-content button:active {
    background-color: #003f7f;
    transform: translateY(1px);
}

.review-form {
    margin-top: 20px;
    background-color: rgba(245, 245, 245, 0.9);
    padding: 20px;
    border-radius: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: auto%;
}

.review-form textarea,
.review-form input[type="text"] {
    width: 100%;
    margin-bottom: 10px;
    padding: 10px;
    border: 1px solid #007bff;
    border-radius: 5px;
    font-size: 1rem;
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: border-color 0.3s ease;
}

.review-form textarea:focus,
.review-form input[type="text"]:focus {
    border-color: #0056b3;
    outline: none;
}

.review-form button {
    background-color: #007bff;
    border: none;
    color: white;
    padding: 15px 20px;
    text-align: center;
    font-size: 1rem;
    margin-top: 10px;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s ease, transform 0.3s ease;
    width: 100%;
}

.review-form button:hover {
    background-color: #0056b3;
    transform: translateY(-2px);
}

.review-form button:active {
    background-color: #003f7f;
    transform: translateY(1px);
}

.reviews {
    margin-top: 10px;
    background-color: rgba(255, 255, 255, 0.9);
    padding: 10px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: auto%;
}

.review {
    border-bottom: 1px solid #007bff;
    padding: 10px 0;
    text-align: left;
}

.review:last-child {
    border-bottom: none;
}

.review p {
    margin: 0;
}

footer {
    background-color: #007bff;
    color: white;
    padding: 20px 0;
    text-align: center;
    width: 100%;
    position: absolute;
    bottom: 0;
}

footer p {
    margin: 0;
    font-size: 0.9rem;
}

footer a {
    color: #fff;
    margin: 0 10px;
    text-decoration: none;
    font-size: 1.2rem;
}

footer a:hover {
    color: #ddd;
}
</style>
<body>

<h1>COLLEGES</h1>

<?php
// Establish connection to the database
$con = mysqli_connect("localhost", "root", "", "educonnect");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_review'])) {
    $clg_id = $_POST['clg_id'];
    $college_type = $_POST['college_type'];
    $user_name = $_POST['user_name'];
    $review = $_POST['review'];
    $query = "INSERT INTO reviews (clg_id, college_type, review, user_name) VALUES ('$clg_id', '$college_type', '$review', '$user_name')";
    mysqli_query($con, $query);
}

// SQL query to retrieve data from the colleges table
if (isset($_GET['clg_id']) && isset($_GET['college_type'])) {
    $clg_id = intval($_GET['clg_id']); // Ensure clg_id is an integer
    $college_type = $_GET['college_type'];

    $query = "SELECT * FROM $college_type WHERE clg_id = '$clg_id'";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo "Error: " . mysqli_error($con);
        exit();
    }

    // Check if there are any rows returned
    if (mysqli_num_rows($result) > 0) {
        // Loop through each row of data
        while ($row = mysqli_fetch_assoc($result)) {
            // Adjust image path if necessary
            $imagePath = $row['clgimage'];
            if (!empty($imagePath)) {
                $imagePath = '' . basename($imagePath);
            }

            // Display each row of data in a card
            echo "<div class='card'>";
            echo "<img src='" . $imagePath . "' alt='College Image'>";
            echo "<div class='card-content'>";
            echo "<h2>" . $row['clgname'] . "</h2>";
            echo "<p>" . nl2br($row['clgdetails']) . "</p>";
            echo "<p><strong>Fee Structure:</strong> " . $row['clgfee'] . "</p>";
            echo "<p><strong>Location:</strong> " . $row['clglocation'] . "</p>";
            if (!empty($row['clglink'])) {
                echo "<a href='" . $row['clglink'] . "'><button>Know More</button></a>";
            }

            // Display review form
            echo "<div class='review-form'>";
            echo "<form method='post' action=''>";
            echo "<input type='hidden' name='clg_id' value='" . $row['clg_id'] . "'>";
            echo "<input type='hidden' name='college_type' value='$college_type'>";
            echo "<input type='text' name='user_name' placeholder='Your Name' required>";
            echo "<textarea name='review' placeholder='Write your review here...' required></textarea>";
            echo "<button type='submit' name='submit_review'>Submit Review</button>";
            echo "</form>";
            echo "</div>";

            // Retrieve and display reviews
            $clg_id = $row['clg_id'];
            $review_query = "SELECT * FROM reviews WHERE clg_id = $clg_id";
            $review_result = mysqli_query($con, $review_query);

            if (mysqli_num_rows($review_result) > 0) {
                echo "<div class='reviews'>";
                while ($review_row = mysqli_fetch_assoc($review_result)) {
                    echo "<div class='review'>";
                    echo "<p><strong>" . htmlspecialchars($review_row['user_name']) . ":</strong></p>";
                    echo "<p>" . htmlspecialchars($review_row['review']) . "</p>";
                    echo "</div>";
                }
                echo "</div>";
            }

            echo "</div>"; // Close card-content
            echo "</div>"; // Close card
        }
    } else {
        echo "No colleges found.";
    }
}

// Close the database connection
mysqli_close($con);
?>
</body>
</html>