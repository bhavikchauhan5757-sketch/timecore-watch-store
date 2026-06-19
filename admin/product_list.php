<?php
include('inc/header.php');

// Redirect to login if admin session is not set
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
?>

<!-- Main content -->
<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">

          <div class="card shadow-lg rounded-lg border-0">
            <div class="card-header bg-gradient-primary text-white">
              <h3 class="card-title"><i class="fas fa-box"></i> Product List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover table-striped text-center align-middle">
                <thead style="background: #343a40b5; color: white;">
                  <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>Main Image</th>
                    <th>Gallery Images</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Created At</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  include('inc/conn.php');
                  $sql = "SELECT p.*, c.c_nm, b.b_name 
                          FROM products p
                          LEFT JOIN categories c ON p.category_id = c.c_id
                          LEFT JOIN brands b ON p.brand_id = b.b_id
                          ORDER BY p.id DESC";
                  $result = mysqli_query($conn, $sql);

                  if (mysqli_num_rows($result) > 0) {
                      while ($row = mysqli_fetch_assoc($result)) {
                          echo "<tr>";
                          echo "<td><span class='badge badge-dark p-2'>" . $row['id'] . "</span></td>";

                          echo "<td><strong class='text-primary'>" . htmlspecialchars($row['name']) . "</strong></td>";

                          // Main Image
                          if (!empty($row['main_image'])) {
                              echo "<td><img src='uploads/products/" . $row['main_image'] . "' class='img-thumbnail' width='60'></td>";
                          } else {
                              echo "<td><span class='text-muted'>No Image</span></td>";
                          }

                          // Gallery Images
                          echo "<td>";
                          if (!empty($row['gallery_images'])) {
                              $gallery = json_decode($row['gallery_images'], true);
                              if (is_array($gallery)) {
                                  foreach ($gallery as $img) {
                                      echo "<img src='uploads/products/" . $img . "' class='img-thumbnail m-1' width='40'>";
                                  }
                              }
                          } else {
                              echo "<span class='text-muted'>No Gallery</span>";
                          }
                          echo "</td>";

                          echo "<td><span class='badge badge-success p-2'>₹" . $row['price'] . "</span></td>";
                          echo "<td><span class='badge badge-info p-2'>" . $row['stock'] . "</span></td>";
                          echo "<td><span class='badge badge-secondary p-2'>" . ($row['c_nm'] ?? 'Uncategorized') . "</span></td>";
                          echo "<td><span class='badge badge-warning p-2'>" . ($row['b_name'] ?? 'No Brand') . "</span></td>";
                          echo "<td><span class='badge badge-info p-2'>" . date('d M Y, h:i A', strtotime($row['time'])) . "</span></td>";

                          // Status Column with Toggle
                          if (strtolower($row['status']) === "active") {
                              echo "<td>
                                      <a href='toggle_product.php?id=" . $row['id'] . "&status=Inactive' 
                                         class='badge badge-success p-2'
                                         onclick=\"return confirm('Do you want to disable this product?');\">
                                        Active
                                      </a>
                                    </td>";
                          } else {
                              echo "<td>
                                      <a href='toggle_product.php?id=" . $row['id'] . "&status=Active' 
                                         class='badge badge-secondary p-2'
                                         onclick=\"return confirm('Do you want to enable this product?');\">
                                        Inactive
                                      </a>
                                    </td>";
                          }

                          // Action buttons
                          echo "<td>
                                  <a href='edit_product.php?id=" . $row['id'] . "' class='btn btn-sm btn-primary m-1'>
                                    <i class='fas fa-edit'></i> Edit
                                  </a>
                                  <a href='delete_product.php?id=" . $row['id'] . "' class='btn btn-sm btn-danger m-1' onclick=\"return confirm('Are you sure to delete this product?');\">
                                    <i class='fas fa-trash'></i> Delete
                                  </a>
                                </td>";

                          echo "</tr>";
                      }
                  } else {
                      echo "<tr><td colspan='11' class='text-center text-muted'>No Products Found</td></tr>";
                  }
                  ?>
                </tbody>
              </table>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
</div>
<!-- /.content -->

<?php
include('inc/footer.php');
?>
