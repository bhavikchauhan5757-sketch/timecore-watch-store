<?php
session_start();
?>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <b>Admin</b>LTE
  </div>
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="login_process.php" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username or Email" name="fnm" value="<?php echo isset($_SESSION['old']['fnm']) ? htmlspecialchars($_SESSION['old']['fnm']) : ''; ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <?php
        if(isset($_SESSION['errors']['fnm'])){
            echo '<p style="color:red;margin-top:-10px;margin-bottom:10px;">'.$_SESSION['errors']['fnm'].'</p>';
            unset($_SESSION['errors']['fnm']);
        }
        ?>

        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="pass">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <?php
        if(isset($_SESSION['errors']['pass'])){
            echo '<p style="color:red;margin-top:-10px;margin-bottom:10px;">'.$_SESSION['errors']['pass'].'</p>';
            unset($_SESSION['errors']['pass']);
        }
        if(isset($_SESSION['errors']['wrong'])){
            echo '<p style="color:red;margin-top:-10px;margin-bottom:10px;">'.$_SESSION['errors']['wrong'].'</p>';
            unset($_SESSION['errors']['wrong']);
        }
        ?>

        <div class="row">
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
        </div>
      </form>
      <p class="mb-0">
        <a href="register.php" class="text-center">Register a new membership</a>
      </p>
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
