<!-- edit_categories.php -->
<?php
require '../database/config.php'; // Include database connection

// Fetch category details based on the ID from the query string
if (isset($_GET['id'])) {
    $categoryId = $_GET['id'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM categories WHERE id = ?");
        $stmt->execute([$categoryId]);
        $category = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit'])) {
    $title = $_POST['pcattitle'];
    $description = $_POST['pcatdesc'];

    // Update category details
    try {
        $stmt = $pdo->prepare("UPDATE categories SET title = ?, description = ? WHERE id = ?");
        $stmt->execute([$title, $description, $categoryId]);
        header("Location: index.php?p=view_cat"); // Redirect back to categories view after update
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
    <title>Edit Product Category</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include "includes/head.php"; ?>
    <?php include "includes/header.php"; ?>
    <?php include "includes/nav.php"; ?>

    <div class="row">
        <div class="col-md-12 col-sm-12 lower-area mt-5 p-2">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">Edit Product Category</h4>
                </div>

                <div class="card-body">
                    <form action="#" method="POST">
                        <div class="row p-1">
                            <div class="col-md-6 col-sm-12">
                                <label for="pcattitle">Product Cat Title</label>
                                <input type="text" name="pcattitle" value="<?= htmlspecialchars($category['title']) ?>" placeholder="Enter Product Cat Title" class="form-control" required>
                            </div>

                            <div class="col-md-6 col-sm-12">
                                <label for="pcatdesc">Product Cat Description</label>
                                <textarea rows="3" name="pcatdesc" placeholder="Enter Product Cat Description" class="form-control" required><?= htmlspecialchars($category['description']) ?></textarea>
                            </div>

                            <div class="col-md-12 col-sm-12 mt-3">
                                <button type="submit" name="edit" value="edit" class="btn btn-primary">Edit Product Category</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include "includes/footer.php"; ?>
</body>
</html>
