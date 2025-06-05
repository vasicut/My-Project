<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login System</title>
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
            background-image: url('image/events.jpg');
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
        
        section {
           
            padding: 20px;
            border-radius: 10px;
            margin: 20px auto;
            max-width: 400px;
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
        <h1>Welcome to Seabrock</h1>
    </header>

    <nav>
        <ul>
            <li><a class="roundedButton" href="event_details.php">Event Details</a></li>
            <li><a class="roundedButton" href="member_details.php">Member Details</a></li>
            <li><a class="roundedButton" href="add_event.php">Add Event Details</a></li>
            <li><a class="roundedButton" href="search.php">Search</a></li>
            <li><a class="roundedButton" href="edit.php">Edit</a></li>
            <li><a class="roundedButton" href="delete.php">Delete</a></li>
            <li><a class="roundedButton" href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <footer>
        <p>&copy; 2024 Event Management by Vasile</p>
    </footer>
</body>
</html>
