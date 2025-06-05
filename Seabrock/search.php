<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["username"])) {
    header("Location: events.php"); // Redirect to the events page if not logged in
    exit();
}

// Back button logic
if (isset($_POST['back'])) {
    header("Location: events.php"); // Redirect to the events page
    exit();
}

$searchResultsFile = []; // Array to store file search results
$searchResultsDB = [];   // Array to store database search results
$fileSearchPerformed = false;
$dbSearchPerformed = false;

// Handle file search request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["search"])) {
    $searchTerm = $_POST["searchTerm"];

    // Load the event details from event_details.php
    $eventDetails = file_get_contents("event_details.php");

    // Extract content from the section with class "content"
    preg_match('/<section class="content">(.*?)<\/section>/s', $eventDetails, $matches);

    // Search for the events based on the search term within the extracted content
    if (isset($matches[1])) {
        preg_match_all("/<li>(.*?)<\/li>/s", $matches[1], $eventMatches);
        foreach ($eventMatches[1] as $match) {
            if (stripos($match, $searchTerm) !== false) {
                $searchResultsFile[] = $match;
            }
        }
    }
    $fileSearchPerformed = true;
}

// Handle database search request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["search"])) {
    $searchTerm = $_POST["searchTerm"];

    $conn = new mysqli("localhost", "root", "", "userdb");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $searchQuery = "SELECT * FROM user_data WHERE name LIKE ? OR email LIKE ? OR message LIKE ?";
    $searchStmt = $conn->prepare($searchQuery);
    $searchTermDB = "%" . $searchTerm . "%";
    $searchStmt->bind_param("sss", $searchTermDB, $searchTermDB, $searchTermDB);
    $searchStmt->execute();
    $searchResultDB = $searchStmt->get_result();

    while ($row = $searchResultDB->fetch_assoc()) {
        $searchResultsDB[] = $row;
    }

    $searchStmt->close();
    $conn->close();
    $dbSearchPerformed = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search and Display</title>
    <style type="text/css">
         .roundedButton {
            border-radius: 10px;
            background-color: darkslategray;
            color: white;
            text-align: center;
            padding: 15px 25px;
            display: inline-block;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image: url('image/search.webp');
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
            color: #fff;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 2px;
            text-align: center;
        }

        h1 {
            font-size: 60px;
            font-family: "Lucida Grande";
            text-align: center;
        }

        nav {
            color: #fff;
            padding: 10px;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
        }

        nav li {
            margin-right: 20px;
        }

        nav a {
            color: #fff;
            text-decoration: none;
        }

     

        p {
            font-family: Arial, sans-serif;
            text-align: center;
            font-size: 10px;
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 0px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <h2>Search and Display</h2>
    </header>
    
    <nav>
        <!-- Search Form -->
        <form action="" method="post">
            <label for="searchTerm">Search:</label>
            <input type="text" name="searchTerm" required>
            <input type="submit" name="search" value="Search">
        </form>
    </nav>

    <?php
    // Display database search results
    if ($dbSearchPerformed) {
        if (!empty($searchResultsDB)) {
            echo "<h3>Database Search Results:</h3>";
            foreach ($searchResultsDB as $event) {
                echo "<ul>";
                echo "<li>Event Title: " . $event["name"] . "</li>";
                echo "<li>Event Description: " . $event["email"] . "</li>";
                echo "<li>Event Date: " . $event["message"] . "</li>";
                echo "</ul>";
            }
        } else {
            echo "No results found.";
        }
    }
    ?>

    <!-- Back Button -->
    <form action="events.php" method="get">
           <li><a class="roundedButton" href="events.php">Back</a></li>
    </form>

    <footer>
        <p>&copy; 2024 Event Management by Vasile</p>
    </footer>
</body>
</html>
