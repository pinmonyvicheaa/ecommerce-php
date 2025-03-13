<!-- view.php -->
<?php
// Include the database connection
include('../database/config.php');

// Fetch products from the database along with their category
$query = "SELECT p.id, p.name, p.image, p.price, p.quantity, p.description, c.title AS category 
          FROM products p 
          LEFT JOIN categories c ON p.category_id = c.id";
$stmt = $pdo->prepare($query);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container-fluid body-area mt-5">
    <div class="row">
        <div class="col-md-12 col-sm-12 view-area mt-2 p-1">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">View Products</h4>
                </div>

                <div class="card-body">
                    <table id="dtBasicExample" class="table table-responsive table-striped table-bordered w-100 d-block d-md-table" cellspacing="0" width="100%">
                        <thead>
                            <th class="th-sm">ID</th>
                            <th class="th-sm">Product Name</th>
                            <th class="th-sm">Product Price</th>
                            <th class="th-sm">Product Image</th>
                            <th class="th-sm">Product Quantity</th>
                            <th class="th-sm">Product Description</th>
                            <th class="th-sm">Product Category</th>
                            <th class="th-sm">Action</th>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td><?= $product['id']; ?></td>
                                    <td><?= htmlspecialchars($product['name']); ?></td>
                                    <td>$<?= number_format($product['price'], 2); ?></td>
                                    <td><img src="<?= htmlspecialchars($product['image']); ?>" alt="Image" class="img-fluid" width="50"></td>
                                    <td><?= $product['quantity']; ?></td>
                                    <td><?= htmlspecialchars($product['description']); ?></td>
                                    <td>
                                        <?= !empty($product['category']) ? htmlspecialchars($product['category']) : 'Insert categories first'; ?>
                                    </td> <!-- Display category title or message -->
                                    <td>
                                        <a href="edit_Product.php?id=<?= $product['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="delete_Product.php?id=<?= $product['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
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
