<!-- insert_categories.php -->
<?php
require '../database/config.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    // Get the values from the form
    $title = $_POST['pcat_title'];
    $description = $_POST['pcat_desc'];

    try {
        // Insert the new category into the database
        $stmt = $pdo->prepare("INSERT INTO categories (title, description) VALUES (?, ?)");
        $stmt->execute([$title, $description]);

        // Redirect to the categories view page after insertion
        header("Location: index.php?p=view_cat");
        exit;

    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product Category</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container-fluid body-area mt-5">
        <div class="row mt-3">
            <div class="col-md-12 col-sm-12 lower-area mt-5 p-2">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">Add Product Category</h4>
                    </div>
                    <div class="card-body">
                        <!-- Form submits to the same page -->
                        <form action="insert_categories.php" method="POST">
                            <div class="row p-1">
                                <div class="col-md-6 col-sm-12">
                                    <label for="pcat_title">Product Category Title</label>
                                    <input type="text" name="pcat_title" placeholder="Enter Category Title"
                                           class="form-control" required>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <label for="pcat_desc">Product Category Description</label>
                                    <textarea rows="3" placeholder="Enter Category Description" name="pcat_desc"
                                              class="form-control" required></textarea>
                                </div>

                                <div class="col-md-12 col-sm-12 mt-3">
                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
