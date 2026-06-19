<?php
include('inc/header.php');

// Redirect to login if admin session is not set
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include('inc/conn.php');

// Get order_id from URL safely
$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;

// Check if order_id exists
if ($order_id <= 0) {
    echo "<div class='container my-5 text-center text-danger'>Invalid Order ID</div>";
    include('inc/footer.php');
    exit;
}

// Get order details (optional, to display customer info)
$order_sql = "SELECT * FROM orders WHERE order_id = $order_id";
$order_result = mysqli_query($conn, $order_sql);
$order = mysqli_fetch_assoc($order_result);

?>

<!-- Main content -->
<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">

          <div class="card shadow-lg rounded-lg border-0">
            <div class="card-header bg-gradient-primary text-white">
              <h3 class="card-title">
                <i class="fas fa-box"></i> Order Items (Order #<?php echo $order_id; ?>)
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

              <?php if ($order): ?>
                <p><strong>Customer:</strong> <?php echo htmlspecialchars($order['name']); ?> | 
                   <strong>Email:</strong> <?php echo htmlspecialchars($order['email']); ?> | 
                   <strong>Mobile:</strong> <?php echo htmlspecialchars($order['mobile']); ?></p>
              <?php else: ?>
                <p class="text-danger">Order not found.</p>
              <?php endif; ?>

              <table id="example1" class="table table-bordered table-hover table-striped text-center align-middle">
                <thead style="background: #343a40; color: white;">
                  <tr>
                    <th>#</th>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql_items = "SELECT * FROM order_items WHERE order_id = $order_id";
                  $result_items = mysqli_query($conn, $sql_items);

                  if (mysqli_num_rows($result_items) > 0) {
                      $i = 1;
                      while ($item = mysqli_fetch_assoc($result_items)) {
                          $subtotal = $item['price'] * $item['quantity'];
                          echo "<tr>";
                          echo "<td>" . $i++ . "</td>";
                          echo "<td>" . $item['product_id'] . "</td>";
                          echo "<td><strong class='text-primary'>" . htmlspecialchars($item['product_name']) . "</strong></td>";
                          echo "<td>₹" . number_format($item['price'], 2) . "</td>";
                          echo "<td>" . $item['quantity'] . "</td>";
                          echo "<td><span class='badge badge-info'>₹" . number_format($subtotal, 2) . "</span></td>";
                          echo "</tr>";
                      }
                  } else {
                      echo "<tr><td colspan='6' class='text-center text-muted'>No Items Found</td></tr>";
                  }
                  ?>
                </tbody>
              </table>

              <div class="text-center mt-4">
                <a href="orders.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back to Orders</a>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

        </div>
      </div>
    </div>
  </section>
</div>

<?php include('inc/footer.php'); ?>
