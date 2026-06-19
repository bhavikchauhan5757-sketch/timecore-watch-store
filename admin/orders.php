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
              <h3 class="card-title"><i class="fas fa-shopping-cart"></i> Orders List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover table-striped text-center align-middle">
                <thead style="background: #343a40; color: white;">
                  <tr>
                    <th>#</th>
                    <th>User ID</th>
                    <th>Customer</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  include('inc/conn.php');
                  $sql = "SELECT * FROM orders ORDER BY order_id DESC";
                  $result = mysqli_query($conn, $sql);

                  if (mysqli_num_rows($result) > 0) {
                      while ($row = mysqli_fetch_assoc($result)) {
                          echo "<tr>";
                          echo "<td><span class='badge badge-dark p-2'>" . $row['order_id'] . "</span></td>";
                          echo "<td><span class='badge badge-secondary'>" . $row['user_id'] . "</span></td>";
                          echo "<td><strong class='text-primary'>" . $row['name'] . "</strong></td>";
                          echo "<td>" . $row['email'] . "</td>";
                          echo "<td>" . $row['mobile'] . "</td>";
                          echo "<td><span class='badge badge-info'>₹" . number_format($row['total'], 2) . "</span></td>";

                          // Status dropdown
                          echo "<td>
                                  <form method='POST' action='update_order_status.php' class='d-inline'>
                                      <input type='hidden' name='order_id' value='" . $row['order_id'] . "'>
                                      <select name='status' class='form-select form-select-sm' onchange='this.form.submit()'>
                                          <option value='pending'" . (strtolower($row['status']) == 'pending' ? " selected" : "") . ">Pending</option>
                                          <option value='confirmed'" . (strtolower($row['status']) == 'confirmed' ? " selected" : "") . ">Confirmed</option>
                                          <option value='processed'" . (strtolower($row['status']) == 'processed' ? " selected" : "") . ">Processed</option>
                                          <option value='completed'" . (strtolower($row['status']) == 'completed' ? " selected" : "") . ">Completed</option>
                                      </select>
                                  </form>
                                </td>";

                          echo "<td><span class='badge badge-dark p-2'>" . date('d M Y, h:i A', strtotime($row['created_at'])) . "</span></td>";

                          // Action buttons
                          echo "<td>
                                  <a href='order_items.php?order_id=" . $row['order_id'] . "' class='btn btn-sm btn-info m-1'>
                                    <i class='fas fa-eye'></i> View Items
                                  </a>
                                  <a href='delete_order.php?id=" . $row['order_id'] . "' class='btn btn-sm btn-danger m-1' onclick=\"return confirm('Are you sure to delete this order?');\">
                                    <i class='fas fa-trash'></i> Delete
                                  </a>
                                </td>";
                          echo "</tr>";
                      }
                  } else {
                      echo "<tr><td colspan='9' class='text-center text-muted'>No Orders Found</td></tr>";
                  }
                  ?>
                </tbody>
              </table>
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
