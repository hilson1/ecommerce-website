<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Category</title>
    <span onclick="window.location.href='adminpanel.php';" class="close" title="Close Modal">&times;</span>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1, h2 {
            color: #333;
        }
        form {
            margin-bottom: 20px;
        }
        form label {
            display: block;
            margin-bottom: 5px;
        }
        form input, form textarea {
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        table th {
            background-color: #f4f4f4;
        }
        button {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
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
   <center><h2>Create New Category</h2></center> 
    <!-- Form to create a new category -->
    <form action="" method="POST" class="form"> <!-- Removed 'categoryadd.php' to allow the same page to handle the form -->
        <!-- Category ID (optional or auto-generated in the database) -->
        <label for="category_id"><b>Category ID:</b></label>
        <input type="number" name="category_id" id="category_id" placeholder="Auto-generated if left blank">
        
        <!-- Category Name -->
        <label for="name"><b>Category Name:</b></label>
        <input type="text" name="name" id="name" required>

        <!-- Category Description -->
        <label for="description"><b>Description:</b></label>
        <textarea name="description" id="description" required></textarea>
        
        <br><br>

        <!-- Submit button -->
        <button type="submit" name="submit">Create Category</button>
    </form>

    <?php
    // Database connection setup
    $host = 'localhost';  // Change to your database host if needed
    $db = 'enepal'; // Your database name
    $user = 'root'; // Your database username
    $pass = ''; // Your database password

    // Create a connection
    $conn = new mysqli($host, $user, $pass, $db);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the form was submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        // Get the form data
        $category_id = isset($_POST['category_id']) && !empty($_POST['category_id']) ? (int)$_POST['category_id'] : null;
        $name = $_POST['name'];
        $description = $_POST['description'];

        // Prepare and bind the SQL statement to prevent SQL injection
        if ($category_id) {
            // If category_id is provided, check if it already exists
            $checkStmt = $conn->prepare("SELECT COUNT(*) FROM categories WHERE category_id = ?");
            $checkStmt->bind_param("i", $category_id);
            $checkStmt->execute();
            $checkStmt->bind_result($count);
            $checkStmt->fetch();
            $checkStmt->close();

            if ($count > 0) {
                echo "<p>Error: Category ID already exists. Please choose a different ID.</p>";
            } else {
                // If category_id is provided and valid, insert with it
                $stmt = $conn->prepare("INSERT INTO categories (category_id, name, description) VALUES (?, ?, ?)");
                $stmt->bind_param("iss", $category_id, $name, $description);
            }
        } else {
            // Insert without specifying category_id (auto-increment)
            $stmt = $conn->prepare("INSERT INTO categories (name, description) VALUES (?, ?)");
            $stmt->bind_param("ss", $name, $description);
        }

        // Execute the query
        if (isset($stmt) && $stmt->execute()) {
            echo "<p>New category created successfully.</p>";
        } else {
            if (isset($stmt)) {
                echo "<p>Error: " . $stmt->error . "</p>";
            }
        }

        // Close the statement if it was created
        if (isset($stmt)) {
            $stmt->close();
        }
    }

    // Fetch and display all categories
    $result = $conn->query("SELECT * FROM categories");
    if ($result->num_rows > 0) {
        echo "<h3>Existing Categories:</h3>";
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li><strong>ID:</strong> " . htmlspecialchars($row['category_id']) . ", <strong>Name:</strong> " . htmlspecialchars($row['name']) . ", <strong>Description:</strong> " . htmlspecialchars($row['description']) . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No categories found.</p>";
    }

    // Close the connection
    $conn->close();
    ?>
</body>
</html>
