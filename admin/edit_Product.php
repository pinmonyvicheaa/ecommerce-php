<?php
// Include the database connection
include('../database/config.php');

// Fetch all categories for the dropdown
$query = "SELECT id, title FROM categories";
$stmt = $pdo->prepare($query);
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check if the product ID is passed via URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Fetch the product data from the database
    $query = "SELECT * FROM products WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $product_id, PDO::PARAM_INT);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    // If no product is found, redirect to view page
    if (!$product) {
        header('Location: index.php?p=products_view');
        exit;
    }
}

// Handle the form submission to update the product
if (isset($_POST['edit'])) {
    $name = $_POST['pname'];
    $price = $_POST['pprice'];
    $quantity = $_POST['pquantity'];
    $description = $_POST['pdesc'];
    $category = $_POST['pcategory']; // Get selected category from form
    
    // Handle image upload
    if ($_FILES['pimg']['name']) {
        $image = '../images/' . basename($_FILES['pimg']['name']);
        move_uploaded_file($_FILES['pimg']['tmp_name'], $image);
    } else {
        // Use the existing image if no new image is uploaded
        $image = $product['image'];
    }

    // Update the product in the database
    $update_query = "UPDATE products SET name = :name, price = :price, image = :image, quantity = :quantity, description = :description, category_id = :category WHERE id = :id";
    $stmt = $pdo->prepare($update_query);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':category', $category); // Bind selected category
    $stmt->bindParam(':id', $product_id);
    $stmt->execute();

    // Redirect back to view page after updating
    header('Location: index.php?p=products_view');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="path/to/your/css/styles.css">
</head>

<body>
    <?php include "includes/head.php"; ?>
    <?php include "includes/header.php"; ?>
    <?php include "includes/nav.php"; ?>

    <div class="row">
        <div class="col-md-12 col-sm-12 lower-area mt-5 p-2">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">Edit Product</h4>
                </div>

                <div class="card-body">
                    <form action="edit_Product.php?id=<?= $product['id']; ?>" method="POST" enctype="multipart/form-data">
                        <div class="row p-1">
                            <div class="col-md-6 col-sm-12">
                                <label for="pname">Product Name</label>
                                <input type="text" name="pname" value="<?= htmlspecialchars($product['name']); ?>" placeholder="Enter Product Name" class="form-control" required>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="pprice">Product Price</label>
                                <input type="text" name="pprice" value="<?= htmlspecialchars($product['price']); ?>" placeholder="Enter Product Price" class="form-control" required>
                            </div>

                            <div class="col-md-6 col-sm-12 mt-3">
                                <label for="pimg">Upload Product Image</label>
                                <input type="file" name="pimg" class="form-control-file">
                            </div>

                            <div class="col-md-6 col-sm-12 mt-3">
                                <label for="pquantity">Product Quantity</label>
                                <input type="number" name="pquantity" value="<?= $product['quantity']; ?>" placeholder="Enter Product Quantity" class="form-control" required>
                            </div>

                            <div class="col-md-12 col-sm-12 mt-3">
                                <label for="pdesc">Description</label>
                                <textarea rows="3" placeholder="Enter Description" name="pdesc" class="form-control" required><?= htmlspecialchars($product['description']); ?></textarea>
                            </div>

                            <!-- Select Product Category -->
                            <div class="col-md-12 col-sm-12 mt-3">
                                <label for="pcategory">Product Category</label>
                                <select name="pcategory" class="form-control" required>
                                    <option value="" disabled>Select Category</option>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?= $category['id']; ?>" 
                                                <?= ($category['id'] == $product['category_id']) ? 'selected' : ''; ?>>
                                                <?= htmlspecialchars($category['title']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-12 col-sm-12 mt-3">
                                <button type="submit" name="edit" value="edit" class="btn btn-primary">Edit Product</button>
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
