<?php
// Include the database connection
include('../database/config.php');

// Check if the product ID is passed via URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Prepare the delete query
    $delete_query = "DELETE FROM products WHERE id = :id";
    $stmt = $pdo->prepare($delete_query);
    $stmt->bindParam(':id', $product_id, PDO::PARAM_INT);
    
    // Execute the delete query
    if ($stmt->execute()) {
        // Redirect to the view page after successful deletion
        header('Location: index.php?p=products_view');
        exit;
    } else {
        // If something goes wrong, redirect back to the view page
        echo "Error deleting product.";
        exit;
    }
} else {
    // If no product ID is passed, redirect back to view page
    header('Location: index.php?p=products_view');
    exit;
}
?>
