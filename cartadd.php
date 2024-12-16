<?php
session_start();
include 'connection.php';

// Debugging: Check if session variable is set
if (!isset($_SESSION['user_id'])) {
    echo "You need to be logged in to add items to the cart.";
    exit;
} else {
    // Debugging: Print user_id to ensure it's set
    echo "User ID: " . $_SESSION['user_id'];
}

$user_id = $_SESSION['user_id'];

// Verify that the user_id exists in the user_table
$user_check = mysqli_query($conn, "SELECT * FROM `user_table` WHERE user_id = '$user_id'");
if (mysqli_num_rows($user_check) == 0) {
    echo "Invalid user. Please log in again.";
    exit;
}

if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $price = $_POST['price'];

    // Check if the product already exists in the cart
    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id' AND product_id = '$product_id'");
    
    if (mysqli_num_rows($select_cart) > 0) {
        // Update the quantity if the product is already in the cart
        $update_cart = mysqli_query($conn, "UPDATE `cart` SET quantity = quantity + 1 WHERE user_id = '$user_id' AND product_id = '$product_id'");
        if ($update_cart) {
            echo "Product quantity updated in the cart!";
        } else {
            echo "Error updating cart: " . mysqli_error($conn);
        }
    } else {
        // Insert a new product into the cart
        $insert_cart = mysqli_query($conn, "INSERT INTO `cart` (user_id, product_id, price, quantity) VALUES ('$user_id', '$product_id', '$price', 1)");
        if ($insert_cart) {
            echo "Product added to cart successfully!";
        } else {
            echo "Error adding product to cart: " . mysqli_error($conn);
        }
    }

    // Redirect to view the cart
    header("Location: cview.php");
    exit;
}
?>
<html>
    <head>
        <title>cart view</title>
     <!-- Style css -->
     <link rel="stylesheet" href="css/style.css">
    <!-- Themify icons -->
    <link rel="stylesheet" href="themify-icons/themify-icons.css">
     <!-- Bootstrap css -->
     <link rel="stylesheet" href="bootstrap css/css/bootstrap.min.css">
    <!-- Responsive css -->
    <link rel="stylesheet" href="css/responsive.css">
    </head>
    <body>
  

    </body>
</html>