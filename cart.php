<?php
session_start();
include('inc/conn.php');

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// ------------------ HANDLE AJAX QUANTITY UPDATE ------------------
if(isset($_POST['ajax_update']) && isset($_POST['id']) && isset($_POST['quantity'])) {
    $cart_id = intval($_POST['id']);
    $qty = max(1, intval($_POST['quantity']));

    $sql = "SELECT c.id AS cart_id, p.price, p.stock 
            FROM cart c 
            JOIN products p ON c.product_id = p.id 
            WHERE c.id = $cart_id AND c.user_id = $user_id";
    $res = mysqli_query($conn, $sql);
    if($res && $row = mysqli_fetch_assoc($res)) {
        $qty = min($qty, $row['stock']);
        mysqli_query($conn, "UPDATE cart SET quantity=$qty WHERE id=$cart_id AND user_id=$user_id");

        $line_total = $row['price'] * $qty;

        $subtotal = 0;
        $sql2 = "SELECT c.quantity, p.price 
                 FROM cart c 
                 JOIN products p ON c.product_id=p.id 
                 WHERE c.user_id=$user_id";
        $res2 = mysqli_query($conn, $sql2);
        while($item = mysqli_fetch_assoc($res2)) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        echo json_encode([
            'line_total' => number_format($line_total, 2),
            'subtotal' => number_format($subtotal, 2),
            'total' => number_format($subtotal + 50, 2)
        ]);
    }
    exit;
}

// ------------------ HANDLE ADD / REMOVE / CLEAR ------------------
if(isset($_GET['action'])) {
    $action = $_GET['action'];

    if($action === 'add' && isset($_GET['id'])) {
        $product_id = intval($_GET['id']);
        $check = mysqli_query($conn, "SELECT * FROM cart WHERE user_id=$user_id AND product_id=$product_id");
        if(mysqli_num_rows($check) > 0){
            mysqli_query($conn, "UPDATE cart SET quantity=quantity+1 WHERE user_id=$user_id AND product_id=$product_id");
        } else {
            mysqli_query($conn, "INSERT INTO cart(user_id, product_id, quantity) VALUES($user_id, $product_id, 1)");
        }
        header("Location: cart.php");
        exit;
    }

    if($action === 'remove' && isset($_GET['id'])) {
        $cart_id = intval($_GET['id']);
        mysqli_query($conn, "DELETE FROM cart WHERE id=$cart_id AND user_id=$user_id");
        header("Location: cart.php");
        exit;
    }

    if($action === 'clear') {
        mysqli_query($conn, "DELETE FROM cart WHERE user_id=$user_id");
        header("Location: cart.php");
        exit;
    }
}

include('inc/header.php');
?>

<div class="cart-section">
    <div class="cart-table-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="table_desc">
                        <div class="table_page table-responsive">
                            <table class="table text-center">
                                <thead>
                                    <tr>
                                        <th>Delete</th>
                                        <th>Image</th>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $subtotal = 0;
                                $sql = "SELECT c.id AS cart_id, p.id AS product_id, p.name, p.price, p.main_image, c.quantity, p.stock 
                                        FROM cart c 
                                        JOIN products p ON c.product_id = p.id 
                                        WHERE c.user_id=$user_id";
                                $res = mysqli_query($conn, $sql);

                                if(mysqli_num_rows($res) > 0):
                                    while($item = mysqli_fetch_assoc($res)):
                                        $line_total = $item['price'] * $item['quantity'];
                                        $subtotal += $line_total;
                                        $imagePath = 'admin/uploads/products/' . ($item['main_image'] ?? '');
                                ?>
                                    <tr data-id="<?= $item['cart_id'] ?>">
                                        <td class="product_remove">
                                            <a href="cart.php?action=remove&id=<?= $item['cart_id'] ?>" onclick="return confirm('Remove this item?')">
                                                <i class="fa fa-trash-o"></i>
                                            </a>
                                        </td>
                                        <td class="product_thumb">
                                            <!-- ✅ FIXED IMAGE DISPLAY -->
                                            <img src="<?= htmlspecialchars($imagePath) ?>" 
                                                 alt="<?= htmlspecialchars($item['name']) ?>" 
                                                 style="max-width:150px; height:auto; object-fit:contain; border-radius:8px;">
                                        </td>
                                        <td class="product_name"><?= htmlspecialchars($item['name']) ?></td>
                                        <td class="product-price">₹<?= number_format($item['price'],2) ?></td>
                                        <td class="product_quantity">
                                            <input type="number" min="1" max="<?= $item['stock'] ?>" value="<?= $item['quantity'] ?>" class="cart-quantity form-control" style="width:70px; margin:auto;">
                                        </td>
                                        <td class="product_total">₹<span class="line_total"><?= number_format($line_total,2) ?></span></td>
                                    </tr>
                                <?php
                                    endwhile;
                                else:
                                    echo '<tr><td colspan="6" class="text-center">Your cart is empty</td></tr>';
                                endif;
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="cart_submit mt-3 text-center">
                            <a href="product.php" class="btn btn-md btn-golden">Continue Shopping</a>
                            <?php if(mysqli_num_rows($res) > 0): ?>
                                <a href="cart.php?action=clear" class="btn btn-md btn-secondary" onclick="return confirm('Clear cart?')">Clear Cart</a>
                                <a href="checkout.php" class="btn btn-md btn-success">Proceed to Checkout</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ✅ Cart Totals (Coupon section removed) -->
    <div class="coupon_area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8 text-center">
                    <h3>Cart Totals</h3>
                    <div class="coupon_inner">
                        <div class="cart_subtotal">
                            <p>Subtotal</p>
                            <p class="cart_amount">₹<span id="subtotal"><?= number_format($subtotal,2) ?></span></p>
                        </div>
                        <div class="cart_subtotal">
                            <p>Shipping</p>
                            <p class="cart_amount"><span>Flat Rate:</span> ₹50.00</p>
                        </div>
                        <div class="cart_subtotal">
                            <p>Total</p>
                            <p class="cart_amount">₹<span id="total"><?= number_format($subtotal+50,2) ?></span></p>
                        </div>
                        <div class="checkout_btn">
                            <a href="checkout.php" class="btn btn-md btn-golden">Proceed to Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
document.querySelectorAll('.cart-quantity').forEach(input => {
    input.addEventListener('change', function(){
        let row = this.closest('tr');
        let id = row.dataset.id;
        let qty = this.value;

        let formData = new FormData();
        formData.append('ajax_update', 1);
        formData.append('id', id);
        formData.append('quantity', qty);

        fetch('cart.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            row.querySelector('.line_total').textContent = data.line_total;
            document.getElementById('subtotal').textContent = data.subtotal;
            document.getElementById('total').textContent = data.total;
        });
    });
});
</script>

<?php include('inc/footer.php'); ?>
