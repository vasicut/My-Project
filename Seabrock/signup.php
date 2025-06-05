<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Establish a connection to the database
    $conn = new mysqli("localhost", "root", "", "userdb");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert user details into the 'users' table
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        //Redirect to login page
        header('location: login.php');

        //echo "User registered successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login System</title>
    <style>
          /* Global Styles */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image: url('image/signup.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
            color: #fff; 
        }
        
      
        
        p {
          
            font-family: Arial, sans-serif;
            text-align: center;
            font-size: 10px;
        }
        
        header {
            background-color: #333;
            color: #fff;
            padding: 2px;
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
        
        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 0px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        
        .roundedButton {
            border-radius: 10px;
            background-color: darkslategray;
            color: white;
            text-align: center;
            padding: 15px 25px;
            display: inline-block;
            margin-bottom: 10px; /* Added margin to separate buttons */
        }

        /* Style for Home and Login buttons */
        nav a.roundedButton {
            background-color: goldenrod;
        }
		
    </style>
</head>
<body>

<header>
    <h1>Sign Up</h1>
</header>

<nav>
    <ul>
        <li><a href="index.php" class="roundedButton">Home</a></li>
        <li><a href="login.php" class="roundedButton">Login</a></li>
    </ul>
</nav>

<section>
    <h2>Create an account</h2>
    <form action="signup.php" method="post">
        <div>
            <label for="username">Username: </label>
            <input type="text" name="username">
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password">
        </div>
        <div>
            <input type="submit" value="Sign Up" class="roundedButton">
        </div>
    </form>
</section>

<footer>
    <p>&copy; 2024 Event Management by Vasile</p>
</footer>

</body>
</html>
