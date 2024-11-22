<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>State Colleges</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('background.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #333;
            padding: 20px;
        }
        .card {
            background-color: rgba(255, 255, 255, 0.9);
            border: 1px solid #007bff; /* Change border color to blue */
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex; /* Display as flex container */
        }

        .card h2 {
            margin-top: 0;
        }

        .card img {
            max-width: 200px;
            height: auto;
            margin-right: 20px; /* Add margin for spacing */
            border-radius: 5px;
        }

        .card-content {
            flex: 1; /* Take remaining space */
        }

        .card button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            margin-top: auto; /* Align button to bottom */
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            align-self: flex-end; /* Align button to bottom */
        }

        .card button:hover {
            background-color: #45a049;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>
<body>

<?php
// Establish connection to the database
$con = mysqli_connect("localhost", "root", "", "educonnect");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Function to display college data
function display_colleges($con, $table_name) {
    // SQL query to retrieve data from the specified table
    $query = "SELECT * FROM $table_name";
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
                // Ensure the path is correct, assuming images are stored in 'images' directory under the web root
                $imagePath = '' . basename($imagePath);
            }

            // Display each row of data in a card
            echo "<div class='card'>";
            echo "<img src='" . $imagePath . "' alt='College Image'>";
            echo "<div class='card-content'>";
            echo "<h2>" . $row['clgname'] . "</h2>";
            echo "<p>" . $row['clgdetails'] . "</p>";
            echo "<p>Fee Structure: " . $row['clgfee'] . "</p>";
            echo "<p>Location: " . $row['clglocation'] . "</p>";
            echo "<p>Review: " . $row['clgreview'] . "</p>";
            if (!empty($row['clglink'])) {
                echo "<a href='" . $row['clglink'] . "'><button>Know More</button></a>";
            }
            echo "</div>"; // Close card-content
            echo "</div>"; // Close card
        }
    } else {
        echo "No colleges found.";
    }
}

// Display commerce colleges
echo "<h1>Commerce Colleges</h1>";
display_colleges($con, "commerce");

// Display arts colleges
echo "<h1>Arts Colleges</h1>";
display_colleges($con, "arts");

// Close the database connection
mysqli_close($con);
?>

</body>
</html>
