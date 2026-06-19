<?php
include('inc/header.php');
// include('inc/db.php'); // make sure this has $conn connection

// Redirect to login if admin session is not set
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

// Fetch only Active categories
$categories = mysqli_query($conn, "SELECT c_id, c_nm FROM categories WHERE c_status = 'Active' ORDER BY c_nm ASC");

// Fetch brands (if you have a brands table)
$brands = mysqli_query($conn, "SELECT b_id,b_name name FROM brands ORDER BY name ASC");
?>

<!-- Content Wrapper -->
<div class="content-wrapper">
  <!-- Content Header -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Add Product</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Add Product</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">

          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add Product</h3>
            </div>

            <!-- form start -->
            <form method="post" action="add_product_process.php" enctype="multipart/form-data">
              <div class="card-body">

                <!-- Product Name -->
                <div class="form-group">
                  <label for="name">Product Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Enter product name" required>
                </div>

                <!-- Short Description -->
                <div class="form-group">
                  <label for="short_description">Short Description</label>
                  <textarea class="form-control" id="short_description" name="short_description" rows="2"></textarea>
                </div>

                <!-- Full Description -->
                <div class="form-group">
                  <label for="description">Full Description</label>
                  <textarea class="form-control" id="description" name="description" rows="4"></textarea>
                </div>

                <!-- Price -->
                <div class="form-group">
                  <label for="price">Price ($)</label>
                  <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                </div>

                <!-- Stock -->
                <div class="form-group">
                  <label for="stock">Stock</label>
                  <input type="number" class="form-control" id="stock" name="stock" required>
                </div>

                <!-- Main Image -->
                <div class="form-group">
                  <label for="main_image">Main Image</label>
                  <input type="file" class="form-control" id="main_image" name="main_image" required>
                </div>

                <!-- Gallery Images -->
                <div class="form-group">
                  <label for="gallery_images">Gallery Images</label>
                  <input type="file" class="form-control" id="gallery_images" name="gallery_images[]" multiple>
                  <small class="form-text text-muted">You can select multiple images</small>
                </div>

                <!-- Category -->
                <div class="form-group">
                  <label for="category_id">Category</label>
                  <select class="form-control" id="category_id" name="category_id" required>
                    <option value="">Select Category</option>
                    <?php
                    if ($categories && mysqli_num_rows($categories) > 0) {
                        while ($row = mysqli_fetch_assoc($categories)) {
                            echo '<option value="'.$row['c_id'].'">'.$row['c_nm'].'</option>';
                        }
                    }
                    ?>
                  </select>
                </div>

                <!-- Brand -->
<div class="form-group">
  <label for="b_id">Brand</label>
  <select class="form-control" id="b_id" name="b_id" required>
    <option value="">Select Brand</option>
    <?php
    // Fetch brand list from DB
    $brands = mysqli_query($conn, "SELECT b_id, b_name FROM brands WHERE status = 1");

    if ($brands && mysqli_num_rows($brands) > 0) {
        while ($row = mysqli_fetch_assoc($brands)) {
            echo '<option value="'.$row['b_id'].'">'.ucfirst($row['b_name']).'</option>';
        }
    } else {
        echo '<option value="">No brands available</option>';
    }
    ?>
  </select>
</div>
                <!-- Status -->
                <div class="form-group">
                  <label for="status">Status</label>
                  <select class="form-control" id="status" name="status">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                  </select>
                </div>

              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>
  </section>
</div>

<?php include('inc/footer.php'); ?>
