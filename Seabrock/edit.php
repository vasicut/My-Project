<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["username"])) {
    header("Location: events.php"); // Redirect to the events page 
    exit();
}

// Handle edit request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit"])) {
    $editId = $_POST["editId"];

    // Redirect to the edit page with the record ID
    header("Location: edit_record.php?id=" . $editId);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Events</title>
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
            background-image: url('image/edit.png');
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
        <h2>Edit Page</h2>
    </header>

    <nav>
        <?php
        // Display the edit buttons for events created by the currently logged-in user
        $conn = new mysqli("localhost", "root", "", "userdb");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and execute query to select events created by the current user
        $searchQuery = "SELECT id, name AS event_title, email AS event_description, message AS event_date FROM user_data WHERE user_id = ?";
        $searchStmt = $conn->prepare($searchQuery);
        $searchStmt->bind_param("i", $_SESSION["user_id"]);
        $searchStmt->execute();
        $searchResult = $searchStmt->get_result();

        if ($searchResult->num_rows > 0) {
            echo "<h3>Records</h3>";

            while ($record = $searchResult->fetch_assoc()) {
                echo "<p>Event Title: " . $record['event_title'] . "</p>";
                echo "<p>Event Description: " . $record['event_description'] . "</p>";
                echo "<p>Event Date: " . $record['event_date'] . "</p>";

                // Edit button
                echo '<form action="edit_record.php" method="get">';
                echo '<input type="hidden" name="editId" value="' . $record['id'] . '">';
                echo '<button type="submit" name="edit">Edit</button>';
                echo '</form>';

                echo "-----------------------------<br>";
            }
        } else {
            echo "No records found.";
        }

        $conn->close();
        ?>
		
        <!-- Back Button -->
        <form action="events.php" method="get">
          <li><a class="roundedButton" href="events.php">Back</a></li>
        </form>
	
    </nav>

    <footer>
        <p>&copy; 2024 Event Management by Vasile</p>
    </footer>
</body>
</html>
