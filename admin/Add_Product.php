<!-- Add_Product.php -->
<?php
// Include the database connection
include('../database/config.php');

// Fetch categories for the dropdown
$stmt = $pdo->query("SELECT id, title FROM categories");
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get form data
    $productName = $_POST['pname'];
    $productPrice = $_POST['pprice'];
    $productQuantity = $_POST['pquantity'];
    $productDesc = $_POST['pdesc'];
    $productCategory = $_POST['pcategory'];  // Get selected category

    // Handle file upload
    if (isset($_FILES['pimg'])) {
        $targetDir = "../images/"; // Define where the uploaded image will be stored
        $targetFile = $targetDir . basename($_FILES['pimg']['name']);
        move_uploaded_file($_FILES['pimg']['tmp_name'], $targetFile); // Move the uploaded file to the target directory
    }

    // Insert product data into the database
    $query = "INSERT INTO products (name, image, price, quantity, description, category_id) 
              VALUES (:name, :image, :price, :quantity, :description, :category)";

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(':name', $productName);
    $stmt->bindParam(':image', $targetFile); // The uploaded image path
    $stmt->bindParam(':price', $productPrice);
    $stmt->bindParam(':quantity', $productQuantity);
    $stmt->bindParam(':description', $productDesc);
    $stmt->bindParam(':category', $productCategory); // Bind selected category

    if ($stmt->execute()) {
        // Redirect to the products view page after successful insertion
        header('Location: index.php?p=products_view');
        exit; // Make sure the script ends here
    } else {
        echo "Error: Could not insert the product.";
    }
}
?>

<div class="container-fluid body-area mt-5">
    <div class="row mt-3">
        <div class="col-md-12 col-sm-12 lower-area mt-5 p-2">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">Add Products</h4>
                </div>
                <div class="card-body">
                    <form action="Add_Product.php" method="POST" enctype="multipart/form-data">
                        <div class="row p-1">
                            <div class="col-md-6 col-sm-12">
                                <label for="">Product Name</label>
                                <input type="text" name="pname" placeholder="Enter Product Name" class="form-control" required>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="">Product Price</label>
                                <input type="number" name="pprice" placeholder="Enter Product Price" class="form-control" required>
                            </div>
                            <div class="col-md-6 col-sm-12 mt-3">
                                <label for="">Upload Product Image</label>
                                <input type="file" name="pimg" class="form-control-file" required>
                            </div>
                            <div class="col-md-6 col-sm-12 mt-3">
                                <label for="">Product Quantity</label>
                                <input type="number" name="pquantity" placeholder="Enter Product Quantity" class="form-control" required>
                            </div>
                            <div class="col-md-12 col-sm-12 mt-3">
                                <label for="">Product Category</label>
                                <select name="pcategory" class="form-control" required>
                                    <option value="" disabled selected>Select Category</option>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?= $category['id']; ?>"><?= htmlspecialchars($category['title']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-12 col-sm-12 mt-3">
                                <label for="">Description</label>
                                <textarea rows="3" placeholder="Enter Description" name="pdesc" class="form-control" required></textarea>
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
