<?php
session_start();
include 'connection.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "You need to be logged in to remove items from the cart.";
    exit;
}

$user_id = $_SESSION['user_id'];

// Verify that the user_id exists in the user_table
$user_check = mysqli_query($conn, "SELECT * FROM `user_table` WHERE user_id = '$user_id'");
if (mysqli_num_rows($user_check) == 0) {
    echo "Invalid user. Please log in again.";
    exit;
}

if (isset($_POST['remove'])) {
    $product_id = $_POST['product_id'];

    // Remove the item from the cart
    $remove_item = mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id' AND product_id = '$product_id'");

    if ($remove_item) {
        echo "Product removed from cart successfully!";
    } else {
        echo "Error removing product from cart: " . mysqli_error($conn);
    }

    // Redirect back to the cart view
    header("Location: cview.php");
    exit;
}
?>
