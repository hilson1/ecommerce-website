<?php
session_start(); // Start the session

// Check if there's a last visited page in the session and redirect to it
if (isset($_SESSION['last_visited_page'])) {
    $last_page = $_SESSION['last_visited_page'];
    header("Location: $last_page"); // Redirect to last visited page
    exit();
} else {
    // If no last page is set, redirect to a default page
    header("Location: /default-page.php");
    exit();
}
?>
