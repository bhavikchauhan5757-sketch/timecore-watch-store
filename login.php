<?php 
include('inc/header.php'); 
?>

<!-- Login Form Section -->
<div class="container px-4 px-md-5 py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 shadow p-4 rounded bg-white">
            <h3 class="mb-4 text-center">Login Form</h3>

            <form action="login_process.php" method="post">
                <div class="default-form-box mb-20">
                    <label for="username">ID</label>
                    <input name="unm" type="text" id="username" class="form-control" 
                        placeholder="Enter Your Username or Email"
                        value="<?php echo isset($_SESSION['old_unm']) ? htmlspecialchars($_SESSION['old_unm']) : ''; ?>" required>
                    <?php 
                        if(isset($_SESSION['error_unm'])){
                            echo "<div class='text-danger mt-1 small'>".$_SESSION['error_unm']."</div>";
                            unset($_SESSION['error_unm']);
                        }
                        if(isset($_SESSION['error_login'])){
                            echo "<div class='text-danger mt-1 small'>".$_SESSION['error_login']."</div>";
                        }
                    ?>
                </div>

                <div class="default-form-box mb-20">
                    <label for="password">Password</label>
                    <input name="pass" type="password" id="password" class="form-control" placeholder="Enter your password" required>
                    <?php 
                        if(isset($_SESSION['error_pass'])){
                            echo "<div class='text-danger mt-1 small'>".$_SESSION['error_pass']."</div>";
                            unset($_SESSION['error_pass']);
                        }
                        if(isset($_SESSION['error_login'])){
                            echo "<div class='text-danger mt-1 small'>".$_SESSION['error_login']."</div>";
                            unset($_SESSION['error_login']);
                        }
                    ?>
                </div>

                <div class="default-form-box text-center mt-3">
                    <button class="btn btn-lg btn-black-default-hover w-100" type="submit">Login</button>
                </div>

                <div class="text-center mt-4">
                    <p>Don't have an account?
                        <a href="registration.php" class="text-decoration-underline"><strong>Register</strong></a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('inc/footer.php'); ?>
