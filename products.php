
<span onclick="window.location.href='adminpanel.php';" class="close" title="Close Modal">&times;</span>
<?php
// Database connection
include 'connection.php';

// Fetch categories
$sql = "SELECT category_id, name FROM categories"; 
$result = $conn->query($sql);

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        // Create or Update
        if ($action === 'create' || $action === 'update') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];
            $category_id = $_POST['category'];
            $image_url = '';

            // Handle image upload
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $target_dir = "images/";
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $image_url = $target_file;
                }
            }

            if ($action === 'create') {
                $sql = "INSERT INTO products (product_name, description, price, quantity, category_id, image_url) 
                        VALUES ('$name', '$description', '$price', '$quantity', '$category_id', '$image_url')";
                
                if ($conn->query($sql) === TRUE) {
                    echo "New product created successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } elseif ($action === 'update') {
                $product_id = $_POST['product_id'];
                $update_sql = "UPDATE products 
                               SET product_name = '$product_name', description = '$description', price = '$price', quantity = '$quantity', category_id = '$category_id', image_url = '$image_url' 
                               WHERE product_id = $product_id";

                if ($conn->query($update_sql) === TRUE) {
                    echo "Product updated successfully";
                } else {
                    echo "Error updating product: " . $conn->error;
                }
            }
        } elseif ($action === 'delete') {
            // Delete product
            $product_id = $_POST['product_id'];
            $delete_sql = "DELETE FROM products WHERE product_id = $product_id";

            if ($conn->query($delete_sql) === TRUE) {
                echo "Product deleted successfully";
            } else {
                echo "Error deleting product: " . $conn->error;
            }
        } elseif ($action === 'edit') {
            // Fetch the product details for editing
            $product_id = $_POST['product_id'];
            $edit_sql = "SELECT * FROM products WHERE product_id = $product_id";
            $edit_result = $conn->query($edit_sql);
            if ($edit_result) {
                $product_to_edit = $edit_result->fetch_assoc();
                // Pre-fill form fields for editing
                $product_name = $product_to_edit['product_name'];
                $description = $product_to_edit['description'];
                $price = $product_to_edit['price'];
                $quantity = $product_to_edit['quantity'];
                $category_id = $product_to_edit['category_id'];
                $image_url = $product_to_edit['image_url'];
            } else {
                echo "Error fetching product for editing: " . $conn->error;
            }
        }
    }
}

// Read all products
$products_sql = "SELECT p.product_id, p.product_name, p.description, p.price, p.quantity, c.name AS category, p.image_url 
                 FROM products p 
                 JOIN categories c ON p.category_id = c.category_id";
$products = $conn->query($products_sql);

if (!$products) {
    echo "Error fetching products: " . $conn->error; 
} else {
    // Group products by category
    $grouped_products = [];
    while ($row = $products->fetch_assoc()) {
        $grouped_products[$row['category']][] = $row;
    }
}

$conn->close(); // Close the database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>

    <link rel="stylesheet" href="css/products.css">
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
    </style>
        <!-- Style css -->
        <link rel="stylesheet" href="css/style.css">
        <!-- Bootstrap css -->
        <link rel="stylesheet" href="bootstrap css/css/bootstrap.min.css">

    <!-- Responsive css -->
    <link rel="stylesheet" href="css/responsive.css">
</head>
<div>
    <center><h2>Create or Add new products</h2></center>
    <form action="" method="POST" enctype="multipart/form-data">


        <input type="hidden" name="product_id" id="product_id" value="<?php echo isset($product_id) ? $product_id : ''; ?>">

        <!-- Product Name -->
        <label for="name">Product Name:</label>
        <input type="text" name="name" id="name" value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>" required>

        <!-- Description -->
        <label for="description">Description:</label>
        <textarea name="description" id="description" required><?php echo isset($description) ? htmlspecialchars($description) : ''; ?></textarea>

        <!-- Price -->
        <label for="price">Price:</label>
        <input type="number" step="0.01" name="price" id="price" value="<?php echo isset($price) ? htmlspecialchars($price) : ''; ?>" required>

        <!-- quantity -->
        <label for="quantity">quantity:</label>
        <input type="number" name="quantity" id="quantity" value="<?php echo isset($quantity) ? htmlspecialchars($quantity) : ''; ?>" required>

        <!-- Category Selection -->
        <label for="category">Category:</label>
        <select name="category" id="category" style="width: 100%; margin-bottom: 10px; padding: 8px; border: 1px solid #ccc;border-radius: 4px;" required>
            <option value="" disabled>Select Category</option>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $selected = (isset($category_id) && $category_id == $row["category_id"]) ? 'selected' : '';
                    echo '<option value="' . $row["category_id"] . '" ' . $selected . '>' . htmlspecialchars($row["name"]) . '</option>';
                }
            } else {
                echo '<option value="" disabled>No categories available</option>';
            }
            ?>
        </select>

        <!-- Image Upload -->
        <label for="file">Choose Image:</label>
        <input type="file" name="image" id="file" accept="image/*">
        
        <br><br>

        <!-- Submit Buttons -->
        <button type="submit" name="action" value="create">Create Product</button>
        <button type="submit" name="action" value="update">Update Product</button>
    </form>

    <!-- Display List of Products by Category -->
    <h2>All Products</h2>
    <div>
        <?php
        // Display products by category
        foreach ($grouped_products as $category_name => $category_products) {
            echo "<h3>$category_name</h3>";
            echo "<table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>quantity</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>";
            foreach ($category_products as $product) {
                echo "<tr>
                    <td>{$product['product_id']}</td>
                    <td>{$product['product_name']}</td>
                    <td>{$product['description']}</td>
                    <td>{$product['price']}</td>
                    <td>{$product['quantity']}</td>
                    <td><img src='{$product['image_url']}' alt='Product Image' width='50'></td>
                    <td>
                        <!-- Delete Form -->
                        <form action='' method='POST' onsubmit='return confirm(\"Are you sure you want to delete this product?\");'>
                            <input type='hidden' name='product_id' value='{$product['product_id']}'>
                            <button type='submit' name='action' value='delete'>Delete</button>
                        </form>
                        
                        <!-- Edit Form -->
                        <form action='' method='POST'>
                            <input type='hidden' name='product_id' value='{$product['product_id']}'>
                            <input type='hidden' name='action' value='edit'>
                            <button type='submit'>Edit</button>
                        </form>
                    </td>
                </tr>";
            }
            echo "</table>";
        }
        ?>
    </div>
</<div>
</div>
      <!-- footer section -->
      <footer>
        <div class="p-3 copyright">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-12 col-lg-6 p-1 p-lg-3 text-center text-lg-start">
                <p class="my-0">Copyright © 2024 <a href="#"> Electro Nepal</a> All Rights Reserved</p>
              </div>
              <div class="col-12 col-lg-6 p-1 p-lg-3 text-center text-lg-end" >
                <p class="my-0">Designed by <a href="#" target=" _blank">Hilson Shrestha</a>.</p>
              </div>
            </div>
          </div>
        </div>
      </footer>

    <script src="js/crud.js"></script>
</body>
</html>
