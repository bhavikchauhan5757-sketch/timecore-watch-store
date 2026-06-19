<?php
include('inc/header.php');
include('inc/conn.php');

// Check if ID is provided
if(!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<script>alert('Invalid Brand ID'); window.location='brand_list.php';</script>";
    exit;
}

$brand_id = intval($_GET['id']);

// Fetch existing brand details
$query = mysqli_query($conn, "SELECT * FROM brands WHERE b_id = $brand_id");
if(mysqli_num_rows($query) == 0) {
    echo "<script>alert('Brand not found'); window.location='brand_list.php';</script>";
    exit;
}

$row = mysqli_fetch_assoc($query);

// Handle form submission
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $brand_name = trim($_POST['b_name']);

    if(empty($brand_name)) {
        $error = "Brand name cannot be empty";
    } else {
        $update = mysqli_query($conn, "UPDATE brands SET b_name = '".mysqli_real_escape_string($conn, $brand_name)."' WHERE b_id = $brand_id");
        if($update) {
            echo "<script>alert('Brand updated successfully'); window.location='brand_list.php';</script>";
            exit;
        } else {
            $error = "Error updating brand";
        }
    }
}
?>

<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid">
      <div class="card shadow-lg border-0">
        <div class="card-header bg-gradient-primary text-white">
          <h3 class="card-title"><i class="fas fa-edit"></i> Edit Brand</h3>
        </div>
        <div class="card-body">
            <?php if(!empty($error)) { ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php } ?>
            <form method="post">
                <div class="form-group">
                    <label>Brand Name</label>
                    <input type="text" name="b_name" class="form-control" value="<?= htmlspecialchars($row['b_name']) ?>" required>
                </div>
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary">Update Brand</button>
                    <a href="brand_list.php" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
      </div>
    </div>
  </section>
</div>

<?php include('inc/footer.php'); ?>
