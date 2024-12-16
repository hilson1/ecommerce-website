<?php
include 'connection.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the request is to fetch the total amount
if (isset($_GET['fetch_amount']) && $_GET['fetch_amount'] === 'true') {
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['success' => false, 'message' => 'User not logged in']);
        exit;
    }

    $user_id = $_SESSION['user_id'];

    // Calculate the total amount from the cart
    $query = "SELECT SUM(price * quantity) AS total_amount FROM cart WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $total_amount = $row['total_amount'] ?? 0;

        echo json_encode(['success' => true, 'total_amount' => $total_amount]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to calculate total amount']);
    }
    exit;
}

// Remaining cview.php code for displaying cart...
?>
