<?php
// Start the session
session_start();

// Include database connection
include("connection.php");

// Check if the user is logged in
if (!isset($_SESSION['user_name'])) {
    // If not logged in, redirect to login page
    header("Location: login.php");
    exit();
}

// Fetch the logged-in user's username from the session
$username = $_SESSION['user_name'];

// Prepare and execute a query to fetch user details from the database
$sql = "SELECT * FROM user_table WHERE user_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// Check if the user exists
if ($result->num_rows > 0) {
    // Fetch user data
    $user = $result->fetch_assoc();
} else {
    echo "<script>alert('User not found!'); window.location.href='login.php';</script>";
    exit();
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        .profile-container {
            width: 90%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
            font-family: Arial, sans-serif;
        }

        .profile-container h2 {
            text-align: center;
        }

        .profile-item {
            margin-bottom: 10px;
            width: 90%;
            margin: 0 auto;
            padding: 20px;
           
            background-color: #f9f9f9;
            font-family: Arial, sans-serif;
        }

        .profile-item label {
            font-weight: bold;
            display: block;
        }

        .profile-item span {
            display: block;
            padding: 5px;
            background-color: #e9e9e9;
            border-radius: 5px;
        }
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


    </style>
</head>
<body>

<div class="">
    <center><h1>User Profile</h1></center>
    <div class="imgcontainer">
      <span onclick="window.location.href='index.php';" class="close" title="Close Modal">&times;</span>
    </div>
    <div class="profile-item">
        <label>User ID:</label>
        <span><?php echo htmlspecialchars($user['user_id']); ?></span>
    </div>
    <div class="profile-item">
        <label>First Name:</label>
        <span><?php echo htmlspecialchars($user['first_name']); ?></span>
    </div>
    <div class="profile-item">
        <label>Last Name:</label>
        <span><?php echo htmlspecialchars($user['last_name']); ?></span>
    </div>
    <div class="profile-item">
        <label>Username:</label>
        <span><?php echo htmlspecialchars($user['user_name']); ?></span>
    </div>
    <div class="profile-item">
        <label>Email:</label>
        <span><?php echo htmlspecialchars($user['email']); ?></span>
    </div>
    <div class="profile-item">
        <label>Phone Number:</label>
        <span><?php echo htmlspecialchars($user['phone_number']); ?></span>
    </div>
    <div class="profile-item">
        <label>Address:</label>
        <span><?php echo htmlspecialchars($user['address']); ?></span>
    </div>
    <div class="profile-item">
        <label>Status:</label>
        <span><?php echo htmlspecialchars($user['status']); ?></span>
    </div>
    <div class="profile-item">
        <label>Verification Code:</label>
        <span><?php echo htmlspecialchars($user['verification_code']); ?></span>
    </div>
</div>

</body>
</html>
