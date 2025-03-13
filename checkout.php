<?php
if (!isset($_SESSION)) {
    session_start();
}
$p = 'checkout';
include "includes/head.php";
include "includes/header.php";
require_once 'PayWayApiCheckout.php';

// Fetch cart items
$cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$cart_total = array_sum(array_map(function ($item) {
    return $item['price'] * $item['quantity'];
}, $cart_items));

// Prepare items for PayWay
$items = [];
foreach ($cart_items as $index => $item) {
    $items[$index]['name'] = $item['name'];
    $items[$index]['quantity'] = $item['quantity'];
    $items[$index]['price'] = $item['price'];
}
$encoded_items = base64_encode(json_encode($items));

// PayWay transaction details
$req_time = time();
$merchant_id = ABA_PAYWAY_MERCHANT_ID;
$transactionId = time();
$amount = number_format($cart_total, 2, '.', '');
$return_params = "Order Completed";
$payment_option = "abapay";
$type = "purchase";
$currency = "KHR";
$return_url = "https://yourdomain.com/thank-you.php";
$hash = PayWayApiCheckout::getHash($req_time . $merchant_id . $transactionId . $amount . $return_params);
?>

<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2 class="h3 mb-3 text-black">Your Order</h2>
                <div class="p-3 p-lg-5 border">
                    <table class="table site-block-order-table mb-5">
                        <thead>
                            <th>Product</th>
                            <th>Total</th>
                        </thead>
                        <tbody>
                            <?php foreach ($cart_items as $item): ?>
                                <tr>
                                    <td><?= htmlspecialchars($item['name']); ?> x <?= $item['quantity']; ?></td>
                                    <td>$<?= number_format($item['price'] * $item['quantity'], 2); ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td><strong>Order Total</strong></td>
                                <td><strong>$<?= number_format($cart_total, 2); ?></strong></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="form-group">
                        <button id="checkout_button" class="btn btn-primary btn-lg btn-block">Proceed to Payment</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<form method="POST" target="aba_webservice" action="<?= PayWayApiCheckout::getApiUrl(); ?>" id="aba_merchant_request">
    <input type="hidden" name="hash" value="<?= $hash; ?>" />
    <input type="hidden" name="tran_id" value="<?= $transactionId; ?>" />
    <input type="hidden" name="amount" value="<?= $amount; ?>" />
    <input type="hidden" name="items" value="<?= $encoded_items; ?>" />
    <input type="hidden" name="return_params" value="<?= $return_params; ?>" />
    <input type="hidden" name="payment_option" value="<?= $payment_option; ?>" />
    <input type="hidden" name="currency" value="<?= $currency; ?>" />
    <input type="hidden" name="type" value="<?= $type; ?>" />
    <input type="hidden" name="return_url" value="<?= $return_url; ?>" />
    <input type="hidden" name="merchant_id" value="<?= $merchant_id; ?>" />
    <input type="hidden" name="req_time" value="<?= $req_time; ?>" />
</form>

<script src="https://checkout.payway.com.kh/plugins/checkout2-0.js"></script>
<script>
    document.getElementById("checkout_button").addEventListener("click", function () {
        AbaPayway.checkout();
    });
</script>

<?php include "includes/footer.php"; ?>
