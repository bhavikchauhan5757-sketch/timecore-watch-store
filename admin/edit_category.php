<?php
session_start();
include('inc/conn.php');

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: category_list.php");
    exit;
}

$id = intval($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $c_nm = mysqli_real_escape_string($conn, $_POST['c_nm']);
    // checkbox = Active if checked, Inactive if not
    $c_status = isset($_POST['c_status']) ? 'Active' : 'Inactive';

    $sql = "UPDATE categories SET c_nm='$c_nm', c_status='$c_status' WHERE c_id=$id";
    mysqli_query($conn, $sql);

    header("Location: category_list.php");
    exit;
}

$result = mysqli_query($conn, "SELECT * FROM categories WHERE c_id=$id");
$category = mysqli_fetch_assoc($result);

include('inc/header.php');
?>

<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid">
      <h3>Edit Category - <?= htmlspecialchars($category['c_nm']) ?></h3>
      <form method="POST">
        <div class="form-group">
          <label>Category Name</label>
          <input type="text" class="form-control" name="c_nm" value="<?= htmlspecialchars($category['c_nm']) ?>" required>
        </div>
        <div class="form-check">
          <input type="checkbox" name="c_status" class="form-check-input" 
            <?= ($category['c_status'] === 'Active') ? 'checked' : '' ?>>
          <label class="form-check-label">Enable</label>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Update</button>
        <a href="category_list.php" class="btn btn-secondary mt-2">Cancel</a>
      </form>
    </div>
  </section>
</div>

<?php include('inc/footer.php'); ?>
