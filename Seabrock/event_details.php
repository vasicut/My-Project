<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "userdb");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch event details
$sql = "SELECT name, email, message FROM user_data";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management System - Event Details</title>
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
            background-image: url('image/event details.jpeg');
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
        <h1>Seabrook Events!</h1>
    </header>

    <nav>
        <ul>
            <li><a class="roundedButton" href="events.php">Back</a></li>
            <li><a class="roundedButton" href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <section class="content">
        <h2>Event Details</h2>
        <?php
        // Check if there are events fetched from the database
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<ul>";
                echo "<li>Event Title: " . $row["name"] . "</li>";
                echo "<li>Event Description: " . $row["email"] . "</li>";
                echo "<li>Event Date: " . $row["message"] . "</li>";
                echo "</ul>";
            }
        } else {
            echo "No events found.";
        }
        ?>
    </section>

    <footer>
        <p>&copy; 2024 Event Management by Vasile</p>
    </footer>
</body>
</html>
