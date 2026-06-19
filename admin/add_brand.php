<?php
session_start();

// Redirect to login if admin session is not set
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include('inc/header.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Add Brand</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Add Brand</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add Brand</h3>
            </div>
            <!-- /.card-header -->
            
            <!-- form start -->
            <form method="post" action="add_brand_process.php">
              <div class="card-body">

                <?php
                if (isset($_SESSION['success']['brand'])) {
                  echo '<p class="alert alert-success">'.$_SESSION['success']['brand'].'</p>';
                  unset($_SESSION['success']['brand']); // clear after showing
                }
                ?>

                <div class="form-group">
                  <label for="brandName">Brand Name</label>
                  <input type="text" class="form-control" id="brandName" placeholder="Enter Brand Name" name="b_name" required>
                </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
        <!--/.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>

<?php
include('inc/footer.php');
?>
