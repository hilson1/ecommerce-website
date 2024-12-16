<?php
session_start();
include 'connection.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $entered_code = trim($_POST['verification_code']);

    if (isset($_SESSION['user_id']) && isset($_SESSION['email'])) {
        $user_id = $_SESSION['user_id'];
        $email = $_SESSION['email'];

        // Fetch the stored verification code from the database
        $sql = "SELECT verification_code FROM user_table WHERE user_id = ? AND email = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("is", $user_id, $email);
            $stmt->execute();
            $stmt->bind_result($verification_code);
            $stmt->fetch();
            $stmt->close();

            // Check if the entered code matches the stored code
            if ($entered_code == $verification_code) {
                // Update user status to active
                $update_sql = "UPDATE user_table SET status = 'active', verification_code = NULL WHERE user_id = ?";
                if ($stmt = $conn->prepare($update_sql)) {
                    $stmt->bind_param("i", $user_id);
                    $stmt->execute();
                    $stmt->close();

                    // Redirect to the profile page or dashboard
                    header("Location: profile.php");
                    exit();
                } else {
                    $errors[] = "Error updating status: " . $conn->error;
                }
            } else {
                $errors[] = "Invalid verification code. Please try again.";
            }
        } else {
            $errors[] = "Database error: " . $conn->error;
        }
    } else {
        $errors[] = "Session expired. Please register again.";
        header("Location: signup.php");
        exit();
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>
<body>
    <h2>Email Verification</h2>
    <?php if (!empty($errors)): ?>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?php echo htmlspecialchars($error); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <form action="verify_email.php" method="POST">
        <label for="verification_code">Enter Verification Code:</label>
        <input type="text" id="verification_code" name="verification_code" required>
        <button type="submit">Verify</button>
    </form>
</body>
</html>
