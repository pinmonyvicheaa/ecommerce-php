<!-- cart.php -->
<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

// Handle removing an item from the cart
if (isset($_GET['remove'])) {
    $product_id = $_GET['remove'];
    unset($_SESSION['cart'][$product_id]);
    header('Location: index.php?p=cart'); // Refresh page to update cart count
    exit;
}

// Add product to the cart
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $quantity = 1; // Default quantity is 1

    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity'] += $quantity;
    } else {
        $_SESSION['cart'][$product_id] = [
            'name' => $product_name,
            'price' => $product_price,
            'image' => $product_image,
            'quantity' => $quantity
        ];
    }
    header('Location: index.php?p=cart'); // Refresh page to update cart count
    exit;
}

// Fetch cart items
$cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="styles.css"> <!-- Include your CSS -->
</head>
<body>
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0">
                    <a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Cart</strong>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row mb-5">
                <form class="col-md-12" method="post">
                    <div class="site-blocks-table">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">Image</th>
                                    <th class="product-name">Product</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-total">Total</th>
                                    <th class="product-remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($cart_items)): ?>
                                    <tr><td colspan="6" class="text-center">Your cart is empty.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($cart_items as $id => $item): ?>
                                        <tr>
                                            <td class="product-thumbnail">
                                            <img src="images/<?= htmlspecialchars($item['image']); ?>" alt="Image" class="img-fluid">
                                            </td>
                                            <td class="product-name"><?= $item['name']; ?></td>
                                            <td class="product-price">$<?= number_format($item['price'], 2); ?></td>
                                            <td class="product-quantity"><?= $item['quantity']; ?></td>
                                            <td class="product-total">$<?= number_format($item['price'] * $item['quantity'], 2); ?></td>
                                            <td class="product-remove">
                                                <a href="cart.php?remove=<?= $id ?>" class="text-danger">Remove</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="row mb-5">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <button class="btn btn-primary btn-sm btn-block">Update Cart</button>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-outline-primary btn-sm btn-block">Continue Shopping</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 pl-5">
                    <div class="row justify-content-end">
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-12 text-right border-bottom mb-5">
                                    <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6"><span class="text-black">Subtotal</span></div>
                                <div class="col-md-6 text-right">
                                    <strong class="text-black">
                                        $<?= number_format(array_sum(array_map(function($item) {
                                            return $item['price'] * $item['quantity'];
                                        }, $cart_items)), 2); ?>
                                    </strong>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-primary btn-lg btn-block" onclick="window.location='checkout.php'">Proceed To Checkout</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
