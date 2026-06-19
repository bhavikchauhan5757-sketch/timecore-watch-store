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
            <h1>General Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Category</li>
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
                <h3 class="card-title">Add Category</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="add_category_process.php">
                <div class="card-body">

                  <?php
                        if (isset($_SESSION['success']['category'])) 
                        {
                          echo '<p class="alert alert-success">'.$_SESSION['success']['category'].'</p>';
                          unset($_SESSION['success']['category']); // optional: clear message after showing
                        }
                    ?>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Category Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Category" name="cnm">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Category Description</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Category Description" name="cdes">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<?php
include('inc/footer.php');
?>