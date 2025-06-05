<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["username"])) {
    header("Location: events.php"); // Redirect to the events page 
    exit();
}

// Initialize variables
$record = null;

// Handle edit request
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["editId"])) {
    $editId = $_GET["editId"];

    // Fetch the record details based on the ID
    $conn = new mysqli("localhost", "root", "", "userdb");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute query
    $editQuery = "SELECT id, name AS event_title, email AS event_description, message AS event_date FROM user_data WHERE id = ?";
    $editStmt = $conn->prepare($editQuery);
    $editStmt->bind_param("i", $editId);
    $editStmt->execute();
    $editResult = $editStmt->get_result();

    // Check if record exists
    if ($editResult->num_rows > 0) {
        // Fetch the record
        $record = $editResult->fetch_assoc();
    } else {
        echo "No event found for editing.";
    }

    // Close statement and connection
    $editStmt->close();
    $conn->close();
}

// Handle update request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    // Get form data
    $updateId = $_POST["updateId"];
    $updateTitle = $_POST["updateTitle"];
    $updateDescription = $_POST["updateDescription"];
    $updateDate = $_POST["updateDate"];

    // Update the record in the database
    $conn = new mysqli("localhost", "root", "", "userdb");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute update query
    $updateQuery = "UPDATE user_data SET name=?, email=?, message=? WHERE id=?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("sssi", $updateTitle, $updateDescription, $updateDate, $updateId);
    $updateStmt->execute();

    // Close statement and connection
    $updateStmt->close();
    $conn->close();

    // Redirect to the events page after updating
    header("Location: events.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
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
        <h2>Edit Event</h2>
    </header>

    <nav>
        <?php
        // Display the edit form
        if ($record) {
            echo "<h3>Edit Event</h3>";
            echo '<form action="" method="post">';
            echo '<input type="hidden" name="updateId" value="' . $record['id'] . '">';
            echo 'Title: <input type="text" name="updateTitle" value="' . $record['event_title'] . '" required><br>';
            echo 'Description: <textarea name="updateDescription" required>' . $record['event_description'] . '</textarea><br>';
            echo 'Date: <input type="date" name="updateDate" value="' . $record['event_date'] . '" required><br>';
            echo '<input type="submit" name="update" value="Update">';
            echo '</form>';
        } else {
            echo "No event found for editing.";
        }
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
