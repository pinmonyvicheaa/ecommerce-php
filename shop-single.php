
<?php 
include "database/config.php"; // Include DB connection

if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']); // Get product ID from URL

    // Fetch product from database
    $query = "SELECT * FROM products WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        die("Product not found!");
    }
} else {
    die("Invalid request!");
}

$p = 'shop-single'; // Define the current page as 'shop-single'
include "includes/head.php";
include "includes/header.php";
?>

<div class="bg-light py-3">
  <div class="container">
    <div class="row">
      <div class="col-md-12 mb-0">
        <a href="index.php">Home</a> <span class="mx-2">/</span> 
        <a href="shop.php">Shop</a> <span class="mx-2">/</span> 
        <strong class="text-black"><?= htmlspecialchars($product['name']); ?></strong>
      </div>
    </div>
  </div>
</div>

<div class="site-section">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="item-entry">
          <img src="<?= htmlspecialchars('images/' . $product['image']); ?>" alt="Image" class="img-fluid">
        </div>
      </div>
      <div class="col-md-6">
        <h2 class="text-black"><?= htmlspecialchars($product['name']); ?></h2>
        <p><?= htmlspecialchars($product['description']); ?></p>
        <p><strong class="text-primary h4">$<?= number_format($product['price'], 2); ?></strong></p>

        <p>Available Quantity: <strong><?= $product['quantity']; ?></strong></p> <!-- Display available quantity -->

        <div class="mb-5">
          <div class="input-group mb-3" style="max-width: 120px;">
            <div class="input-group-prepend">
              <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
            </div>
            <input type="number" class="form-control text-center" value="1" min="1" max="<?= $product['quantity']; ?>"> <!-- Limit quantity selection based on stock -->
            <div class="input-group-append">
              <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
            </div>
          </div>
        </div>

        <form action="index.php?p=cart" method="post">
          <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
          <input type="hidden" name="product_name" value="<?= htmlspecialchars($product['name']); ?>">
          <input type="hidden" name="product_price" value="<?= $product['price']; ?>">
          <input type="hidden" name="product_image" value="<?= htmlspecialchars($product['image']); ?>">
          <input type="hidden" name="product_quantity" value="<?= $product['quantity']; ?>"> <!-- Include quantity in the form -->
          <button class="btn btn-primary btn-block mt-2" type="submit">Add to Cart</button>
        </form>

      </div>
    </div>
  </div>
</div>

<?php include "includes/footer.php"; ?>
