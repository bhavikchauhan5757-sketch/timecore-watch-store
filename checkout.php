<?php
session_start();
include('inc/conn.php');
include('inc/header.php');

// Redirect to login if user not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch cart items from DB
$cart_items = [];
$subtotal = 0;

$sql = "SELECT c.id AS cart_id, p.id AS product_id, p.name, p.price, p.stock, c.quantity
        FROM cart c
        JOIN products p ON c.product_id = p.id
        WHERE c.user_id = $user_id";
$res = mysqli_query($conn, $sql);
if ($res) {
    while ($row = mysqli_fetch_assoc($res)) {
        $cart_items[] = $row;
        $subtotal += $row['price'] * $row['quantity'];
    }
}

// Message holder (from session)
$message = "";
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']); // clear after showing once
}
?>

<div class="checkout-section my-5">
    <div class="container">

        <!-- Display message here -->
        <?php if (!empty($message)) echo $message; ?>

        <div class="row">

            <!-- Billing Details -->
            <div class="col-lg-6">
                <h4>Billing Details</h4>
                <form method="post" action="checkout_process.php">
                    <input type="hidden" name="user_id" value="<?= $user_id ?>">
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Mobile</label>
                        <input type="text" name="mobile" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Address</label>
                        <textarea name="address" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label>City</label>
                        <input type="text" name="city" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Pin Code</label>
                        <input type="text" name="pin" class="form-control" required>
                    </div>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-6">
                <h4>Your Order</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($cart_items)): ?>
                            <?php foreach ($cart_items as $item): 
                                $line_total = $item['price'] * $item['quantity'];
                            ?>
                            <tr>
                                <td><?= htmlspecialchars($item['name']) ?></td>
                                <td><?= $item['quantity'] ?></td>
                                <td>₹<?= number_format($line_total,2) ?></td>
                            </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="2">Subtotal</td>
                                <td>₹<?= number_format($subtotal,2) ?></td>
                            </tr>
                            <tr>
                                <td colspan="2">Shipping</td>
                                <td>₹50.00</td>
                            </tr>
                            <tr>
                                <td colspan="2"><strong>Total</strong></td>
                                <td><strong>₹<?= number_format($subtotal+50,2) ?></strong></td>
                            </tr>
                        <?php else: ?>
                            <tr><td colspan="3" class="text-center">Your cart is empty</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <?php if(!empty($cart_items)): ?>
                    <button type="submit" name="place_order" class="btn btn-success btn-block mt-3">Place Order</button>
                <?php endif; ?>
                </form>
            </div>

        </div>
    </div>
</div>

<?php include('inc/footer.php'); ?>

<!-- SweetAlert2 for popup -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php if (!empty($message) && strpos($message, 'success') !== false): ?>
<script>
Swal.fire({
    icon: "success",
    title: "Order Placed!",
    text: "Your order has been placed successfully.",
    confirmButtonColor: "#28a745"
});
</script>
<?php endif; ?>
