<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>College Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('background.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #333;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #007bff;
            margin-bottom: 40px;
        }
        .card {
            background-color: rgba(255, 255, 255, 0.9);
            border: 1px solid #007bff;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: row;
            align-items: flex-start;
        }
        .card h2 {
            margin-top: 0;
        }
        .card img {
            max-width: 300px;
            height: auto;
            margin-right: 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .card-content {
            flex: 1;
        }
        .card button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            align-self: flex-start;
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

<h1> SCHOOLS</h1>

<?php
// Establish connection to the database
$con = mysqli_connect("localhost", "root", "", "educonnect");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// SQL query to retrieve data from the icseschool table
$query = "SELECT * FROM icseschool";
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
            // Ensure the path is correct, assuming images are stored in 'images' directory under the web root
            $imagePath = '' . basename($imagePath);
        }

        // Display each row of data in a card
        echo "<div class='card'>";
        echo "<a href='school_details.php?schoolid=" . $row['schoolid'] . "&school_type=icseschool'><img src='" . $imagePath . "' alt='School Image'></a>";
        echo "<div class='card-content'>";
        echo "<h2>" . $row['schoolname'] . "</h2>";
        echo "<p>" . nl2br($row['schooldetails']) . "</p>";
        echo "<p><strong>Fee Structure:</strong> " . $row['schoolfee'] . "</p>";
        echo "<p><strong>Location:</strong> " . $row['schoollocation'] . "</p>";
        echo "<p><strong>Review:</strong> " . nl2br($row['schoolreview']) . "</p>";
        if (!empty($row['schoollink'])) {
            echo "<a href='" . $row['schoollink'] . "'><button>Know More</button></a>";
        }
        echo "</div>"; // Close card-content
        echo "</div>"; // Close card
    }
} else {
    echo "No schools found.";
}

// Close the database connection
mysqli_close($con);
?>

</body>
</html>
