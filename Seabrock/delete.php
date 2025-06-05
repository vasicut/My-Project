<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Event</title>
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
            background-image: url('image/delete.jpg');
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
            color: #ff0000;
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
        <h2>Delete Page</h2>
    </header>

    <nav>
        <?php
        session_start();

        // Check if the user is logged in
        if (!isset($_SESSION["username"])) {
            header("Location: events.php");
            exit();
        }

        // Handle delete request
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
            $deleteId = $_POST["deleteId"];

            $conn = new mysqli("localhost", "root", "", "userdb");

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Prepare and execute query to delete event
            $deleteQuery = "DELETE FROM user_data WHERE id = ?";
            $deleteStmt = $conn->prepare($deleteQuery);
            $deleteStmt->bind_param("i", $deleteId);
            $deleteStmt->execute();

            if ($deleteStmt->affected_rows > 0) {
                $message = "Event deleted successfully!";
            } else {
                $error = "Failed to delete event. Please try again.";
            }

            $deleteStmt->close();
            $conn->close();
        }

        // Display the delete buttons for events created by the currently logged-in user
        $conn = new mysqli("localhost", "root", "", "userdb");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $searchQuery = "SELECT id, name, email, message FROM user_data WHERE user_id = ?";
        $searchStmt = $conn->prepare($searchQuery);
        $searchStmt->bind_param("i", $_SESSION["user_id"]);
        $searchStmt->execute();
        $searchResult = $searchStmt->get_result();

        if ($searchResult->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Event Title</th><th>Event Description</th><th>Event Date</th><th>Action</th></tr>";

            while ($row = $searchResult->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["message"] . "</td>";
                echo '<td><form action="" method="post">';
                echo '<input type="hidden" name="deleteId" value="' . $row['id'] . '">';
                echo '<button type="submit" name="delete">Delete</button>';
                echo '</form></td>';
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No records found.";
        }

        $conn->close();
        ?>
        <!-- Back Button -->
        <form action="events.php" method="get">
            <button class="roundedButton" type="submit">Back</button>
        </form>
    </nav>

    <footer>
        <p>&copy; 2024 Event Management by Vasile</p>
    </footer>
</body>
</html>
