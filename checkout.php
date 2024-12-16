<?php
require 'connection.php';
session_start(); // Start the session

// Fetch user data if the user is logged in
$user_id = $_SESSION['user_id'] ?? null; // Replace with your actual session key for user ID
$user_data = null;

if ($user_id) {
    $user_sql = "SELECT user_name, email, phone_number, address FROM user_table WHERE user_id='$user_id'";
    $user_result = mysqli_query($conn, $user_sql);

    if ($user_result && mysqli_num_rows($user_result) > 0) {
        $user_data = mysqli_fetch_assoc($user_result);
    }
}

// Fetch product details
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $sql = "SELECT * FROM products WHERE product_id='$product_id'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $product_name = $row["product_name"];
        $price = $row["price"];
        $del_charge = 100;
        $total_price = $price + $del_charge;
        $image_url = $row['image_url'];
    } else {
        echo "No product found.";
        $product_name = $quantity = $price = $del_charge = $total_price = null; // Initialize to avoid warnings
    }
} else {
    echo "No product ID provided.";
    $product_name = $quantity = $price = $del_charge = $total_price = null; // Initialize to avoid warnings
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="themify-icons/themify-icons.css">
    <link rel="stylesheet" href="bootstrap css/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/responsive.css">
    <style>
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
        .checkout-box {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px 0;
        }
        @media (max-width: 576px) {
            .checkout-box {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 mb-5">
                <div class="checkout-box">
                <span onclick="window.location.href='category.php';" class="close" title="Close Modal">&times;</span>
                    <h2 class="text-center p-2 text-primary">Details to complete your order</h2>
                    <h3>Product Details:</h3>
                    <table class="table table-bordered table-responsive">
                        <tr>
                            <th>Product Name:</th>
                            <td><?= htmlspecialchars($product_name); ?></td>
                            <td rowspan="5" class="text-center"><img src="<?= htmlspecialchars($image_url); ?>" class="img-fluid" alt="Product Image"></td>
                        </tr>
                        <tr>
                            <th>Product Price:</th>
                            <td>Rs. <?= number_format($price, 2); ?>/-</td>
                        </tr>
                        <tr>
                            <th>Delivery Charge:</th>
                            <td>Rs. <?= number_format($del_charge, 2); ?>/-</td>
                        </tr>
                        <tr>
                            <th>Total Price:</th>
                            <td>Rs. <?= number_format($total_price, 2); ?>/-</td>
                        </tr>
                    </table>
                    
                    <h4>Enter your details:</h4>
                    <form action="pay.php" method="POST" accept-charset="utf-8">
                        <input type="hidden" name="product_name" value="<?= htmlspecialchars($product_name); ?>">
                        <input type="hidden" name="price" value="<?= htmlspecialchars($price); ?>">

                        <div class="form-group mb-3">
                            <input type="text" name="name" class="form-control" placeholder="Enter your name" value="<?= htmlspecialchars($user_data['user_name'] ?? ''); ?>" required>
                        </div>
                        
                        <div class="form-group mb-3">
                            <input type="text" name="email" class="form-control" placeholder="Enter your email" value="<?= htmlspecialchars($user_data['email'] ?? ''); ?>" required>
                        </div>
                        
                        <div class="form-group mb-3">
                            <input type="text" name="phone_number" class="form-control" placeholder="Enter your phone number" value="<?= htmlspecialchars($user_data['phone_number'] ?? ''); ?>" required>
                        </div>
                        
                        <div class="form-group mb-3">
                            <input type="text" name="address" class="form-control" placeholder="Enter your address" value="<?= htmlspecialchars($user_data['address'] ?? ''); ?>" required>
                        </div>
                        
                        <div class="form-group mb-3">
                            <input type="submit" name="submit" class="btn btn-danger btn-lg w-100" value="Click to pay : Rs. <?= number_format($total_price); ?>/-">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
