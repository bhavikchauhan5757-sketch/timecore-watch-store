<?php
session_start();
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
$old = isset($_SESSION['old']) ? $_SESSION['old'] : [];
// Clear errors after showing
unset($_SESSION['errors'], $_SESSION['old']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Registration Page</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <b>Admin</b>LTE
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form action="register_process.php" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Full name" name="fnm" value="<?= isset($old['fnm']) ? htmlspecialchars($old['fnm']) : '' ?>">
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-user"></span></div>
          </div>
        </div>
        <?php if(isset($errors['fnm'])): ?><p class="text-danger"><?= $errors['fnm'] ?></p><?php endif; ?>

        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email" value="<?= isset($old['email']) ? htmlspecialchars($old['email']) : '' ?>">
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-envelope"></span></div>
          </div>
        </div>
        <?php if(isset($errors['email'])): ?><p class="text-danger"><?= $errors['email'] ?></p><?php endif; ?>

        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Mobile Number" name="mno" value="<?= isset($old['mno']) ? htmlspecialchars($old['mno']) : '' ?>">
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-phone"></span></div>
          </div>
        </div>
        <?php if(isset($errors['mno'])): ?><p class="text-danger"><?= $errors['mno'] ?></p><?php endif; ?>

        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="pass">
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-lock"></span></div>
          </div>
        </div>
        <?php if(isset($errors['pass'])): ?><p class="text-danger"><?= $errors['pass'] ?></p><?php endif; ?>

        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Retype password" name="rpass">
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-lock"></span></div>
          </div>
        </div>
        <?php if(isset($errors['rpass'])): ?><p class="text-danger"><?= $errors['rpass'] ?></p><?php endif; ?>

        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree" <?= isset($old['terms']) && $old['terms']=='agree' ? 'checked' : '' ?>>
              <label for="agreeTerms">I agree to the <a href="#">terms</a></label>
            </div>
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
        </div>
      </form>
      <a href="login.php" class="text-center">I already have a membership</a>
    </div>
  </div>
</div>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
