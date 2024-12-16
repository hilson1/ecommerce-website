<!-- this code helps to fetch the products data and display it in user view format -->
<?php

include("connection.php");
$products_sql = "SELECT p.product_id, p.product_name, p.description, p.price, p.quantity, c.name AS category, p.image_url 
                 FROM products p 
                 JOIN categories c ON p.category_id = c.category_id";
$products = $conn->query($products_sql);

if (!$products) {
    echo "Error fetching products: " . $conn->error; 
    exit; // Stop the script if there's an error
}
else{
    echo"";
}

// Group products by category
$grouped_products = [];
while ($row = $products->fetch_assoc()) {
    $grouped_products[$row['category']][] = $row;
}

$conn->close(); // Close the database connection
?>