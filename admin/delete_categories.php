<!-- delete_categories.php -->
<?php
require '../database/config.php'; // Include database connection

// Check if the 'id' is set in the query string
if (isset($_GET['id'])) {
    $categoryId = $_GET['id'];

    try {
        // Prepare the delete query to remove the category
        $stmt = $pdo->prepare("DELETE FROM categories WHERE id = ?");
        $stmt->execute([$categoryId]);

        // Redirect back to the categories view page after deletion
        header("Location: index.php?p=view_cat");
        exit;

    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
} else {
    die("Invalid request. Category ID not specified.");
}
?>
