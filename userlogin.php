<?php
// Start the session
session_start();
include("connection.php");

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize form data
    $username = mysqli_real_escape_string($conn, $_POST['uname']);
    $password = mysqli_real_escape_string($conn, $_POST['psw']);

    // Query to check if the username exists
    $sql = "SELECT * FROM user_table WHERE user_name = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User found, fetch user data
        $row = $result->fetch_assoc();
        $stored_password = $row['password']; // Password from the database

        // Direct comparison of passwords (no hashing)
        if ($password === $stored_password) {
            // Password is correct, set session variables
            $_SESSION['user_id'] = $row['user_id']; // Store user_id in session
            $_SESSION['user_name'] = $username; // Store username in session
            
            header("Location: index.php"); // Redirect to a protected page
            exit();
        } else {
            // Incorrect password
            echo "<script>alert('Invalid Password!'); window.location.href='login.html';</script>";
        }
    } else {
        // Username not found
        echo "<script>alert('Invalid Username!'); window.location.href='login.html';</script>";
    }
}

$conn->close();
?>



<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {font-family: Arial, Helvetica, sans-serif;}
        /* Full-width input fields */
        input[type=text], input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
            border-radius: 5px;
        }
        /* Set a style for all buttons */
        button {
            background-color: #04AA6D;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            border-radius: 5px;
        }
        button:hover {
            opacity: 0.8;
        }
        /* Extra styles for the cancel button */
        .cancelbtn {
            width: auto;
            padding: 10px 18px;
            background-color: #f44336;
        }
        /* Center the image and position the close button */
        .imgcontainer {
            text-align: center;
            margin: 24px 0 12px 0;
            position: relative;
        }
        img.avatar {
            width: 40%;
            border-radius: 50%;
        }
        .container {
            padding: 16px;
        }
        span.psw {
            float: right;
            padding-top: 16px;
        }
        /* The Modal (background) */
        .modal {
            display: block; /* Make modal visible by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0, 0, 0); /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
            padding-top: 60px;
        }
        /* Modal Content/Box */
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
            border: 1px solid #a02f2f;
            width: 80%; /* Could be more or less, depending on screen size */
        }
        /* The Close Button (x) */
        .close {
            position: absolute;
            right: 25px;
            top: 0;
            color: #000;
            font-size: 35px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: red;
            cursor: pointer;
        }
        /* Add Zoom Animation */
        .animate {
            -webkit-animation: animatezoom 0.6s;
            animation: animatezoom 0.6s;
        }
        @-webkit-keyframes animatezoom {
            from { -webkit-transform: scale(0) }
            to { -webkit-transform: scale(1) }
        }
        @keyframes animatezoom {
            from { transform: scale(0) }
            to { transform: scale(1) }
        }
        /* Change styles for span and cancel button on extra small screens */
        @media screen and (max-width: 300px) {
            span.psw {
                display: block;
                float: none;
            }
            .cancelbtn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div id="id01" class="modal">
        <form class="modal-content animate" action="#" method="post">
            <div class="imgcontainer">
                <span onclick="window.location.href='index.php';" class="close" title="Close Modal">&times;</span>
                <img src="images/log.png" alt="Avatar" class="avatar">
            </div>

            <div class="container">
                <label for="uname"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="uname" required>

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="psw" required>

                <button type="submit">Login</button>

                <button type="button" onclick="window.location.href='signup.php'" class="btn">Signup</button>
                <label>
                    <input type="checkbox" checked="checked" name="remember"> Remember me
                </label>
            </div>

            <div class="container" style="background-color:#f1f1f1">
                <button type="button" onclick="window.location.href='login.html'" class="cancelbtn">Cancel</button>
                <span class="psw">Forgot <a href="forgotpass.html">password?</a></span>
            </div>
        </form>
    </div>
</body>
</html>