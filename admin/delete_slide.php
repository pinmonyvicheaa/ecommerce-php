<?php
// Include the database connection
include('../database/config.php');

// Check if the 'id' is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare the delete query
    try {
        $stmt = $pdo->prepare("DELETE FROM sliders WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        // Execute the delete query
        if ($stmt->execute()) {
            // Redirect to the view page after successful deletion
            header('Location: index.php?p=slide_view');
            exit;
        } else {
            // If something goes wrong
            echo "Error deleting slide.";
            exit;
        }
    } catch (PDOException $e) {
        // Handle error
        echo "Error: " . $e->getMessage();
        exit;
    }
} else {
    // If no 'id' is provided in the URL, redirect back to view page
    header('Location: index.php?p=slide_view');
    exit;
}
?>
