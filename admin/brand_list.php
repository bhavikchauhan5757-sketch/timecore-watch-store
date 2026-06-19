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
              <h3 class="card-title"><i class="fas fa-tags"></i> Brands List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover table-striped text-center align-middle">
                <thead style="background: #343a40; color: white;">
                  <tr>
                    <th>#</th>
                    <th>Brand Name</th>
                    <th>Created At</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  include('inc/conn.php');
                  $sql = "SELECT * FROM brands ORDER BY b_id DESC";
                  $result = mysqli_query($conn, $sql);

                  if (mysqli_num_rows($result) > 0) {
                      while ($row = mysqli_fetch_assoc($result)) {
                          echo "<tr>";
                          echo "<td><span class='badge badge-dark p-2'>" . $row['b_id'] . "</span></td>";
                          echo "<td><strong class='text-primary'>" . $row['b_name'] . "</strong></td>";
                          echo "<td><span class='badge badge-info p-2'>" . date('d M Y, h:i A', strtotime($row['time'])) . "</span></td>";

                          echo '<td>
    <a href="toggle_brand.php?id=' . $row['b_id'] . '" 
       class="btn btn-sm ' . ($row['status'] == 1 ? 'btn-success' : 'btn-secondary') . '" 
       onclick="return confirm(\'Are you sure you want to change the status?\');">
       ' . ($row['status'] == 1 ? 'Active' : 'Inactive') . '
    </a>
</td>';



                          // Action buttons
                          echo "<td>
                                  <a href='edit_brand.php?id=" . $row['b_id'] . "' class='btn btn-sm btn-primary m-1'>
                                    <i class='fas fa-edit'></i> Edit
                                  </a>
                                  <a href='delete_brand.php?id=" . $row['b_id'] . "' class='btn btn-sm btn-danger m-1' onclick=\"return confirm('Are you sure to delete this brand?');\">
                                    <i class='fas fa-trash'></i> Delete
                                  </a>";

                          echo "</td>";
                          echo "</tr>";
                      }
                  } else {
                      echo "<tr><td colspan='5' class='text-center text-muted'>No Brands Found</td></tr>";
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
