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
              <h3 class="card-title"><i class="fas fa-users"></i> Users List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover table-striped text-center align-middle">
                <thead style="background: #343a40; color: white;">
                  <tr>
                    <th>#</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  include('inc/conn.php');

                  $sql = "SELECT * FROM user ORDER BY u_id DESC";
                  $result = mysqli_query($conn, $sql);

                  if (mysqli_num_rows($result) > 0) {
                      while ($row = mysqli_fetch_assoc($result)) {
                          echo "<tr>";
                          echo "<td><span class='badge badge-dark p-2'>" . $row['u_id'] . "</span></td>";
                          echo "<td><strong class='text-primary'>" . $row['u_fnm'] . "</strong></td>";
                          echo "<td>" . $row['u_email'] . "</td>";
                          echo "<td>" . $row['u_mn'] . "</td>";
                      }
                  } else {
                      echo "<tr><td colspan='6' class='text-center text-muted'>No Users Found</td></tr>";
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
