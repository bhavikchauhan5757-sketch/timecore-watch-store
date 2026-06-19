<?php
session_start();
include('inc/conn.php');

// Allow only admin
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: product_list.php");
    exit;
}

$id = intval($_GET['id']);
$result = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
$product = mysqli_fetch_assoc($result);

include('inc/header.php');
?>

<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid">
      <h3>Edit Product - <?= htmlspecialchars($product['name']) ?></h3>
      <form method="POST" enctype="multipart/form-data" action="update_product.php">
        <input type="hidden" name="id" value="<?= $product['id'] ?>">

        <div class="form-group">
          <label>Product Name</label>
          <input type="text" class="form-control" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>
        </div>

        <div class="form-group">
          <label>Price</label>
          <input type="number" step="0.01" class="form-control" name="price" value="<?= $product['price'] ?>" required>
        </div>

        <div class="form-group">
          <label>Stock</label>
          <input type="number" class="form-control" name="stock" value="<?= $product['stock'] ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="product_list.php" class="btn btn-secondary">Cancel</a>
      </form>
    </div>
  </section>
</div>

<?php include('inc/footer.php'); ?>
