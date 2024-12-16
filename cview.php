<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart View</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="themify-icons/themify-icons.css">
    <link rel="stylesheet" href="bootstrap css/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/responsive.css">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .cancelbtn, .btnn {
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: opacity 0.3s;
            width: 100%; /* Full width for buttons */
        }

        .cancelbtn {
            background-color: tomato;
            color: white;
        }

        .cancelbtn:hover {
            opacity: 0.8;
        }

        .btnn {
            background-color: #04AA6D;
            color: white;
            margin-top: 10px; /* Add margin for spacing */
        }

        .btnn:hover {
            opacity: 0.8;
        }

        .product-image {
            width: 100px; /* Fixed width for images */
            height: auto; /* Maintain aspect ratio */
        }

        @media (max-width: 768px) {
            th, td {
                font-size: 14px; /* Smaller font size for mobile */
                padding: 8px; /* Smaller padding for mobile */
            }

            .product-image {
                width: 75px; /* Smaller image size for mobile */
            }
        }

        @media (max-width: 480px) {
            th, td {
                padding: 6px; /* Even smaller padding for very small screens */
            }

            .product-image {
                width: 60px; /* Smaller image size for very small screens */
            }
        }
    </style>
</head>
<body>
    <!-- Navigation section -->
    <section id="header">
        <nav class="navbar navbar-expand-lg bg-white fixed-top">
            <div class="container">
              <a class="navbar-brand" href="#">
                <img src="images/LOGO.png" class="img-fluid" alt="Logo">
              </a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="ti-align-justify navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                  <li class="nav-item"><a class="nav-link" href="index.php"><b>Home</b></a></li>
                  <li class="nav-item"><a class="nav-link" href="category.php"><b>Category</b></a></li>
                  <li class="nav-item"><a class="nav-link" href="#special"><b>Special</b></a></li>
                  <li class="nav-item"><a class="nav-link" href="#contact"><b>Contact</b></a></li>
                  <li class="nav-item">
                      <?php
                      if (session_status() == PHP_SESSION_NONE) {
                          session_start();
                      }
                      if (isset($_SESSION['user_name'])) {
                          echo '<a class="nav-link" href="profile.php"><b>Profile</b></a>';
                          echo '</li><li class="nav-item"><a class="nav-link" href="logout.php"><b>Logout</b></a>';
                      } else {
                          echo '<a class="nav-link" href="login.html"><b>Login</b></a>';
                      }
                      ?>
                  </li>
                  <li class="nav-item"><a class="nav-link active" aria-current="page" href="cview.php"><b>Cart</b></a></li>
                </ul>
              </div>
            </div>
          </nav>
    </section>

    <div class="container" style="margin-top: 80px;">
        <center><h1>Shopping Cart</h1></center>
        <?php
            include 'connection.php';

            // Check if user is logged in
            if (!isset($_SESSION['user_id'])) {
                echo "You need to be logged in to view the cart.";
                exit;
            }

            $user_id = $_SESSION['user_id'];

            // Verify that the user_id exists in the user_table
            $user_check = mysqli_query($conn, "SELECT * FROM `user_table` WHERE user_id = '$user_id'");
            if (mysqli_num_rows($user_check) == 0) {
                echo "Invalid user. Please log in again.";
                exit;
            }

            // Fetch cart items for the logged-in user, including product images
            $query = "SELECT c.product_id, c.price, c.quantity, p.product_name, p.image_url 
                    FROM cart c 
                    JOIN products p ON c.product_id = p.product_id 
                    WHERE c.user_id = '$user_id'";

            $result = mysqli_query($conn, $query);

            // Check for errors in the query
            if (!$result) {
                die("Error fetching cart items: " . mysqli_error($conn));
            }

            // Display cart items
            if (mysqli_num_rows($result) > 0) {
                echo "<h2>Your Cart</h2>";
                echo "<table class='table table-bordered'>
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>";

                // Calculate total price for each item and overall
                $total_amount = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $total_price = $row['price'] * $row['quantity'];
                    $total_amount += $total_price;

                    echo "<tr>
                            <td><img src='" . htmlspecialchars($row['image_url']) . "' class='product-image' alt='" . htmlspecialchars($row['product_name']) . "'></td>
                            <td>" . htmlspecialchars($row['product_name']) . "</td>
                            <td>Rs" . number_format($row['price'], 2) . "</td>
                            <td>" . $row['quantity'] . "</td>
                            <td>Rs" . number_format($total_price, 2) . "</td>
                            <td>
                                <form action='removecart.php' method='post'>
                                    <input type='hidden' name='product_id' value='" . $row['product_id'] . "'>
                                    <button type='submit' class='cancelbtn' name='remove'>Remove</button>
                                </form>
                            </td>
                        </tr>";
                }

                echo "<tr>
                        <td colspan='4' style='text-align:right;'><strong>Total Amount:</strong></td>
                        <td><strong>Rs" . number_format($total_amount, 2) . "</strong></td>
                        <td></td>
                    </tr>";
                echo "</tbody></table>";
            } else {
                echo "<h1>Your cart is empty.</h1>";
            }
            mysqli_close($conn);
        ?>

        <button onclick="window.location.href='continueshopping.php'" class="btnn">Continue Shopping</button>
        <button onclick="window.location.href='buy.php'" class="btnn">Buy Now</button>
    </div>

    <!-- scroll back -->
    <div id="scrollUp" title="scroll To Top">
        <a href="#home"><span class="ti-arrow-up fs-4 text-white"></span></a>
    </div><br><br><br>

    <!-- footer section -->
    <footer>
        <div class="p-3 copyright">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 col-lg-6 p-1 p-lg-3 text-center text-lg-start">
                        <p class="my-0">Copyright © 2024 <a href="#"> Electro Nepal</a> All Rights Reserved</p>
                    </div>
                    <div class="col-12 col-lg-6 p-1 p-lg-3 text-center text-lg-end">
                        <p class="my-0">Designed by <a href="#" target="_blank">Hilson Shrestha</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="bootstrap css/js/bootstrap.bundle.min.js"></script> <!-- Include Bootstrap JS -->
</body>
</html>
