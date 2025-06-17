<!-- home.php -->
<?php
// Include the database connection
include('database/config.php');

// Fetch products from the database
$query = "SELECT * FROM products";
$stmt = $pdo->prepare($query);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Shop -->
<div class="site-section">
  <div class="container">
    <div class="row">
      <div class="title-section mb-5 col-12 text-center">
        <h2 class="text-uppercase font-weight-bold">Popular Products</h2>
      </div>
    </div>
    <div class="row">
      <?php foreach ($products as $product): ?>
      <div class="col-lg-4 col-md-6 item-entry mb-4">
        <a href="shop-single.php?id=<?= $product['id']; ?>" class="product-item md-height bg-light d-block rounded shadow-sm p-3">
        <img src="<?= htmlspecialchars('images/' . $product['image']); ?>" alt="Image" class="img-fluid rounded">
        </a>
        <h2 class="item-title mt-2 text-center">
          <a href="shop-single.php?id=<?= $product['id']; ?>" class="text-dark">
            <?= htmlspecialchars($product['name']); ?>
          </a>
        </h2>
        <strong class="item-price d-block text-center text-success">
          <?php if ($product['original_price']): ?>
            <del class="text-muted">$<?= number_format($product['original_price'], 2); ?></del> 
          <?php endif; ?>
          $<?= number_format($product['price'], 2); ?>
        </strong>
        <div class="star-rating text-center text-warning">
          <?php for ($i = 0; $i < $product['rating']; $i++): ?>
            &#9733;
          <?php endfor; ?>
        </div>
        <!-- Form to Add to Cart -->
        <form action="index.php?p=cart" method="post">
          <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
          <input type="hidden" name="product_name" value="<?= htmlspecialchars($product['name']); ?>">
          <input type="hidden" name="product_price" value="<?= $product['price']; ?>">
          <input type="hidden" name="product_image" value="<?= htmlspecialchars($product['image']); ?>">
          <button class="btn btn-primary btn-block mt-2" type="submit">Add to Cart</button>
        </form>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
