<?php
// signup.php
session_start();
include 'connection.php';

// Initialize variables for error messages
$errors = [];

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Sanitize and fetch form input
    $first_name       = trim($_POST['fname']);
    $last_name        = trim($_POST['lname']);
    $user_name        = trim($_POST['uname']);
    $email            = trim($_POST['email']);
    $phone_number     = trim($_POST['contact']);
    $address          = trim($_POST['address']);
    $password         = $_POST['psw'];       // Password field
    $confirm_password = $_POST['repsw'];     // Confirm Password field

    // Server-side password validation
    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long.";
    }

    // Check if passwords match
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match. Please try again.";
    }

    // Validate email format and check if it's a Gmail address
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    } elseif (!preg_match('/@gmail\.com$/', $email)) {
        $errors[] = "Email must be a Gmail address (ending with @gmail.com).";
    }

    // Validate phone number (assuming 10 digits)
    if (!preg_match('/^\d{10}$/', $phone_number)) {
        $errors[] = "Contact number must be exactly 10 digits.";
    }

    // If no validation errors, proceed
    if (empty($errors)) {
        // Define default status
        $status = 'inactive'; // Set to inactive until email is verified

        // Check if username or email already exists
        $check_sql = "SELECT user_id FROM user_table WHERE user_name = ? OR email = ?";
        if ($stmt = $conn->prepare($check_sql)) {
            $stmt->bind_param("ss", $user_name, $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                // Username or email already exists
                $errors[] = "Username or Email already exists. Please choose another.";
            }
            $stmt->close();
        } else {
            $errors[] = "Database error occurred.";
        }

        // If no errors after checking uniqueness, insert the user
        if (empty($errors)) {
            // Generate a random six-digit verification code
            $verification_code = rand(100000, 999999);

            // Insert query without password hashing
            $insert_sql = "INSERT INTO user_table (first_name, last_name, user_name, password, email, phone_number, address, status, verification_code) 
                          VALUES ('$first_name', '$last_name', '$user_name', '$password', '$email', '$phone_number', '$address', '$status', '$verification_code')";

            if ($stmt = $conn->prepare($insert_sql)) {
                // No need to bind parameters as we have already embedded values in the SQL query

                if ($stmt->execute()) {
                    // Send verification email
                    $to = $email;
                    $subject = "Email Verification";
                    $message = "Your verification code is: " . $verification_code;
                    $headers = "From: no-reply@yourdomain.com";

                    if (mail($to, $subject, $message, $headers)) {
                        // Get the inserted user's ID
                        $user_id = $stmt->insert_id;

                        // Set session variables for verification
                        $_SESSION['user_id']   = $user_id;
                        $_SESSION['email']     = $email;

                        // Redirect to verification page
                        header("Location: verify_email.php");
                        exit();
                    } else {
                        $errors[] = "Failed to send verification email.";
                    }
                } else {
                    $errors[] = "Error during registration: " . $stmt->error;
                }

                $stmt->close();
            } else {
                $errors[] = "Database error occurred.";
            }
        }
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
    <title>Signup Form</title>
    <style>
        body {font-family: Arial, Helvetica, sans-serif;}
        /* Full-width input fields */
        input[type=text], input[type=password],input[type=email],input[type=tel] {
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
  
  <form class="modal-content animate" action="signup.php" method="post" onsubmit="return validatePassword()">
    <div class="imgcontainer">
      <span onclick="window.location.href='index.php';" class="close" title="Close Modal">&times;</span>
      <img src="images/sn.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
      <?php
      // Display error messages if any
      if (!empty($errors)) {
          echo '<div class="error">';
          foreach ($errors as $error) {
              echo '<p>' . htmlspecialchars($error) . '</p>';
          }
          echo '</div>';
      }
      ?>
      
      <label for="fname"><b>First Name</b></label>
      <input type="text" placeholder="Enter First Name" name="fname" id="fname" required>

      <label for="lname"><b>Last Name</b></label>
      <input type="text" placeholder="Enter Last Name" name="lname" id="lname" required>

      <label for="uname"><b>User Name</b></label>
      <input type="text" placeholder="Enter User Name" name="uname" id="uname" required>

      <label for="email"><b>Email</b></label>
      <input type="email" placeholder="Enter Email" name="email" id="email" required>

      <label for="contact"><b>Contact</b></label>
      <input type="tel" id="contact" placeholder="Enter Contact Number" name="contact" pattern="\d{10}" maxlength="10" required>

      <label for="address"><b>Address</b></label>
      <input type="text" placeholder="Full Address" name="address" id="address" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" id="password" placeholder="Enter Password" name="psw" required>

      <label for="repsw"><b>Confirm Password</b></label>
      <input type="password" id="repassword" placeholder="Confirm Password" name="repsw" required>

      <button type="submit">Signup</button>
      <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
      </label>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="window.location.href='userlogin.php'" class="cancelbtn">Cancel</button>
    </div>
  </form>
</div>

<script>
  // Validate password match and length
  function validatePassword() {
    var password = document.getElementById('password').value;
    var repassword = document.getElementById('repassword').value;

    // Check if password is at least 8 characters long
    if (password.length < 8){
      alert("Password must be at least 8 characters long.");
      return false;
    }

    // Check if passwords match
    if (password !== repassword) {
      alert("Passwords do not match. Please try again.");
      return false; // Prevent form submission
    }
    return true; // Allow form submission
  }
</script>

</body>
</html>
