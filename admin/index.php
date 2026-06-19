<?php
session_start();

// Redirect to login if admin session is not set
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include('inc/header.php');
include('inc/conn.php'); // adjust path
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Fetch Data -->
      <?php

      // count products
      $productCount = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS c FROM products"))['c'] ?? 0;

      // count orders
      $orderCount = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS c FROM orders"))['c'] ?? 0;

      // count users
      $userCount = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS c FROM user"))['c'] ?? 0;

      // count admins
      $adminCount = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS c FROM admin"))['c'] ?? 0;
      ?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
        <!-- Products -->
        <div class="col-lg-3 col-6">
          <div class="small-box bg-primary">
            <div class="inner">
              <h3><?php echo $productCount; ?></h3>
              <p>Products</p>
            </div>
            <div class="icon">
              <i class="fas fa-box-open"></i>
            </div>
            <a href="product_list.php" class="small-box-footer">
              More info <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <!-- Orders -->
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?php echo $orderCount; ?></h3>
              <p>Orders</p>
            </div>
            <div class="icon">
              <i class="fas fa-shopping-cart"></i>
            </div>
            <a href="orders.php" class="small-box-footer">
              More info <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <!-- Users -->
        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3><?php echo $userCount; ?></h3>
              <p>Users</p>
            </div>
            <div class="icon">
              <i class="fas fa-users"></i>
            </div>
            <a href="users_list.php" class="small-box-footer">
              More info <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <!-- Admins -->
        <div class="col-lg-3 col-6">
          <div class="small-box bg-success">
            <div class="inner">
              <h3><?php echo $adminCount; ?></h3>
              <p>Admins</p>
            </div>
            <div class="icon">
              <i class="fas fa-user-shield"></i>
            </div>
            <a href="admin_list.php" class="small-box-footer">
              More info <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
      </div>

        <!-- /.row -->
        <!-- Main row -->
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<?php include('inc/footer.php'); ?>
