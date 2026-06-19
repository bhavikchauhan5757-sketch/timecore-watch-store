<?php include('inc/header.php'); ?>



<!-- Registration Form Section -->
<div class="container px-4 px-md-5 py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 shadow p-4 rounded bg-white">
            <h3 class="mb-4 text-center">Registration Form</h3>

            <form id="registration-form" action="registration_process.php" method="post">
                <div class="default-form-box mb-20">
                    <label for="funame">Full Name</label>
                    <input name="fnm" type="text" id="funame" class="form-control" placeholder="Enter your full name" required>
                </div>

                <div class="default-form-box mb-20">
                    <label for="mobile">Mobile Number</label>
                    <input name="mn" type="tel" id="mobile" class="form-control" pattern="[0-9]{10}" placeholder="Enter your mobile number" required>
                </div>

                <div class="default-form-box mb-20">
                    <label for="email">Email</label>
                    <input name="em" type="email" id="email" class="form-control" placeholder="Enter your email address" required>
                </div>

                <div class="default-form-box mb-20">
                    <label for="password">Password</label>
                    <input name="pass" type="password" id="password" class="form-control" placeholder="Enter a password" required>
                </div>

                <div class="default-form-box mb-20">
                    <label for="confirm-password">Confirm Password</label>
                    <input name="cpass" type="password" id="confirm-password" class="form-control" placeholder="Re-enter your password" required>
                </div>

                <div class="default-form-box text-center">
                    <button class="btn btn-lg btn-black-default-hover w-100" type="submit">Register</button>
                </div>

                <!-- ✅ Login Option -->
                <div class="text-center mt-4">
                    <p>Already have an account?
                        <a href="login.php" class="text-decoration-underline"><strong>Login </strong></a>
                    </p>
                </div>

                <p class="form-messege mt-3 text-center text-success"></p>
            </form>
        </div>
    </div>
</div>

<?php include('inc/footer.php'); ?>
