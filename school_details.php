<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Schools</title>
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
            flex: 1;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center; /* Center content vertically */
            text-align: center; /* Center text horizontally */
        }

        .card {
            background-color: rgba(255, 255, 255, 0.95);
            border: 1px solid #007bff;
            border-radius: 10px;
            padding: 20px;
            margin: 20px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            width: 100%;
        }

        .card h2 {
            margin-top: 0;
            color: #007bff;
            font-size: 1.8rem;
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

        .review-form {
            margin-top: 40px;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
        }

        .review-form textarea,
        .review-form input[type="text"] {
            width: 100%;
            margin-bottom: 10px;
            padding: 15px;
            border: 1px solid #007bff;
            border-radius: 5px;
            font-size: 1rem;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
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
            transition: background-color 0.3s ease;
            width: 100%;
        }

        .review-form button:hover {
            background-color: #0056b3;
        }

        footer {
            background-color: #007bff;
            color: white;
            padding: 10px 0;
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
</head>
<body>

<h1>SCHOOLS</h1>

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
    $schoolid = $_POST['schoolid'];
    $school_type = $_POST['school_type'];
    $user_name = $_POST['user_name'];
    $review = $_POST['review'];
    $query = "INSERT INTO school_reviews (schoolid, school_type, user_name, review) VALUES ('$schoolid', '$school_type', '$user_name', '$review')";
    mysqli_query($con, $query);
}

// Determine which table to query based on the URL parameter
if (isset($_GET['school_type']) && isset($_GET['schoolid'])) {
    $school_type = $_GET['school_type'];
    $schoolid = intval($_GET['schoolid']); // Ensure school_id is an integer
    $valid_school_types = ['stateschool', 'icseschool', 'cbseschool'];

    if (in_array($school_type, $valid_school_types)) {
        // SQL query to retrieve data from the specified school table
        $query = "SELECT * FROM $school_type WHERE schoolid = $schoolid";
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
                $imagePath = $row['schoolimage'];
                if (!empty($imagePath)) {
                    $imagePath = '' . basename($imagePath);
                }

                // Display each row of data in a card
                echo "<div class='card'>";
                echo "<img src='" . $imagePath . "' alt='School Image'>";
                echo "<div class='card-content'>";
                echo "<h2>" . $row['schoolname'] . "</h2>";
                echo "<p>" . nl2br($row['schooldetails']) . "</p>";
                echo "<p><strong>Fee Structure:</strong> " . $row['schoolfee'] . "</p>";
                echo "<p><strong>Location:</strong> " . $row['schoollocation'] . "</p>";
                if (!empty($row['schoollink'])) {
                    echo "<a href='" . $row['schoollink'] . "'><button>Know More</button></a>";
                }

                // Display review form
                echo "<div class='review-form'>";
                echo "<form method='post' action=''>";
                echo "<input type='hidden' name='school_id' value='" . $row['schoolid'] . "'>";
                echo "<input type='hidden' name='school_type' value='$school_type'>";
                echo "<input type='text' name='user_name' placeholder='Your Name' required>";
                echo "<textarea name='review' placeholder='Write your review here...' required></textarea>";
                echo "<button type='submit' name='submit_review'>Submit Review</button>";
                echo "</form>";
                echo "</div>";

                // Retrieve and display reviews
                $review_query = "SELECT * FROM school_reviews WHERE schoolid = $schoolid AND school_type = '$school_type'";
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
            echo "No school found.";
        }
    } else {
        echo "Invalid school type.";
    }
} else {
    echo "No school type bbbbb or ID specified.";
}

// Close the database connection
mysqli_close($con);
?>
</body>
</html>
