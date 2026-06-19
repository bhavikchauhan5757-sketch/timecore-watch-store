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

          <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
              <h3 class="card-title"><i class="fas fa-list-alt"></i> Categories List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover table-striped text-center align-middle">
                <thead class="thead-dark">
                  <tr>
                    <th>#</th>
                    <th>Category Name</th>
                    <th>Description</th>
                    <th>Created At</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  include('inc/conn.php');
                  $sql = "SELECT * FROM categories ORDER BY c_id DESC";
                  $result = mysqli_query($conn, $sql);

                  if ($result && mysqli_num_rows($result) > 0) {
                      while ($row = mysqli_fetch_assoc($result)) {
                          $id = (int)$row['c_id'];
                          $name = htmlspecialchars($row['c_nm']);
                          $des  = htmlspecialchars($row['c_des']);
                          $time = date('d M Y, h:i A', strtotime($row['c_time']));
                          $status = $row['c_status']; // expected 'Active' or 'Inactive'

                          echo "<tr>";
                          echo "<td><span class='badge badge-dark'>{$id}</span></td>";
                          echo "<td><strong>{$name}</strong></td>";
                          echo "<td>{$des}</td>";
                          echo "<td><span class='badge badge-info'>{$time}</span></td>";

                          // Status badge with toggle link (use correct DB values 'Active'/'Inactive')
                          if ($status === 'Active') {
                              // clicking will set to Inactive
                              echo "<td>
                                      <a href='toggle_category.php?id={$id}&status=inactive' 
                                         class='badge badge-success' 
                                         onclick=\"return confirm('Are you sure you want to deactivate this category?');\">
                                         Active
                                      </a>
                                    </td>";
                          } else {
                              // clicking will set to Active
                              echo "<td>
                                      <a href='toggle_category.php?id={$id}&status=active' 
                                         class='badge badge-secondary' 
                                         onclick=\"return confirm('Are you sure you want to activate this category?');\">
                                         Inactive
                                      </a>
                                    </td>";
                          }

                          // Action buttons
                          echo "<td>
                                  <a href='edit_category.php?id={$id}' class='btn btn-sm btn-primary m-1'>
                                    <i class='fas fa-edit'></i> Edit
                                  </a>
                                  <a href='delete_category.php?id={$id}' class='btn btn-sm btn-danger m-1' onclick=\"return confirm('Are you sure to delete this category?');\">
                                    <i class='fas fa-trash'></i> Delete
                                  </a>
                                </td>";

                          echo "</tr>";
                      }
                  } else {
                      echo "<tr><td colspan='6' class='text-center text-muted'>No Categories Found</td></tr>";
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
