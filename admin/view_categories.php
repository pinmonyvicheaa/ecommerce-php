<!-- view_categories.php -->
<?php
require '../database/config.php'; // Include database connection

try {
    $stmt = $pdo->query("SELECT id, title, description FROM categories");
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Product Categories</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container-fluid body-area mt-5">
        <div class="row">
            <div class="col-md-12 col-sm-12 view-area mt-2 p-1">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">View Product Categories</h4>
                    </div>
                    <div class="card-body">
                        <table id="dtBasicExample" class="table table-responsive table-striped table-bordered w-100 d-block d-md-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="th-sm">Product Cat ID</th>
                                    <th class="th-sm">Product Cat Title</th>
                                    <th class="th-sm">Product Cat Description</th>
                                    <th class="th-sm">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($categories as $category): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($category['id']) ?></td>
                                        <td><?= htmlspecialchars($category['title']) ?></td>
                                        <td><?= htmlspecialchars($category['description']) ?></td>
                                        <td>
                                            <a href="edit_categories.php?id=<?= $category['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="delete_categories.php?id=<?= $category['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
