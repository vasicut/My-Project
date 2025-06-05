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
            background-image: url('image/Seabrook.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
            color: #fff; 
        }
        
        h1 {
            font-size: 80px;
            font-family: "Lucida Grande", sans-serif;
            text-align: center;
            margin: 0;
            padding: 50px 0;
        }

        p {
            font-family: Arial, sans-serif;
            text-align: center;
            font-size: 10px;
        }

        /* Navigation Styles */
        nav {
           
            text-align: center;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        nav li {
            display: inline-block;
            margin-right: 20px;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            font-size: 8px;
        }

        /* Button Styles */
        .signupButton, .loginButton {
            border-radius: 10px;
            padding: 15px 25px;
            display: inline-block;
            text-align: center;
            cursor: pointer;
            font-size: 18px;
            margin-right: 20px;
        }

        .signupButton {
            background-color: darkslategray;
            color: white;
        }

        .loginButton {
            background-color: goldenrod;
            color: white;
        }

        /* Footer Styles */
        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 0px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome!</h1>
    </header>

    <nav>
        <ul>
            <?php if (!isset($_SESSION['user_id'])): ?>
                <li><a class="signupButton" href="signup.php">Sign Up</a></li>
                <li><a class="loginButton" href="login.php">Login</a></li>
                
            <?php else: ?>
                <li><a href="logout.php">Logout</a></li>
                <li><a href="event_details.php">Events</a></li>
              
            <?php endif; ?>
        </ul>
    </nav>

  

    <footer>
        <p> &copy; 2024 Event Management by Vasile</p>
    </footer>
</body>
</html>
