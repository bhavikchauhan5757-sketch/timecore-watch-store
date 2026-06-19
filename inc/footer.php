<!-- Start Footer Section -->
<footer class="footer-section footer-bg text-light py-5" style="background-color:#111;">
    <div class="container">
        <div class="row text-center text-md-start mb-5">
            <!-- INFORMATION -->
            <div class="col-md-4 mb-4">
                <h5 class="text-warning mb-3">INFORMATION</h5>
                <ul class="list-unstyled">
                    <li><a href="delevery_info.php" class="text-secondary text-decoration-none d-block mb-2">Delivery Information</a></li>
                    <li><a href="term_condition.php" class="text-secondary text-decoration-none d-block mb-2">Terms & Conditions</a></li>
                    <li><a href="contact.php" class="text-secondary text-decoration-none d-block mb-2">Contact</a></li>
                </ul>
            </div>

            <!-- CATEGORIES -->
            <div class="col-md-4 mb-4">
                <h5 class="text-warning mb-3">CATEGORIES</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-secondary text-decoration-none d-block mb-2">Classic</a></li>
                    <li><a href="#" class="text-secondary text-decoration-none d-block mb-2">Sports</a></li>
                    <li><a href="#" class="text-secondary text-decoration-none d-block mb-2">Luxury</a></li>
                    <li><a href="#" class="text-secondary text-decoration-none d-block mb-2">Vintage</a></li>
                    <li><a href="#" class="text-secondary text-decoration-none d-block mb-2">Casual</a></li>
                    <li><a href="#" class="text-secondary text-decoration-none d-block">Formal</a></li>
                </ul>
            </div>

            <!-- ABOUT US -->
            <div class="col-md-4 mb-4">
                <h5 class="text-warning mb-3">ABOUT US</h5>
                <p class="text-secondary">
                    Welcome to <strong>TimeCore</strong>, your trusted destination for premium analog watches.
                    We believe that a watch is more than just a timepiece — it’s a symbol of style, precision, and personality.
                </p>
            </div>
        </div>

        <!-- Social Links -->
        <?php
        include('conn.php');
        $query = mysqli_query($conn, "SELECT * FROM site_settings LIMIT 1");
        $site = mysqli_fetch_assoc($query);
        ?>
        <div class="text-center mb-4">
            <h4 class="text-warning mb-3">FOLLOW US</h4>
            <ul class="list-inline mb-0">
                <?php if (!empty($site['facebook_url'])): ?>
                    <li class="list-inline-item"><a href="<?= htmlspecialchars($site['facebook_url']); ?>" target="_blank" class="text-light fs-5"><i class="fab fa-facebook-f"></i></a></li>
                <?php endif; ?>
                <?php if (!empty($site['twitter_url'])): ?>
                    <li class="list-inline-item"><a href="<?= htmlspecialchars($site['twitter_url']); ?>" target="_blank" class="text-light fs-5"><i class="fab fa-twitter"></i></a></li>
                <?php endif; ?>
                <?php if (!empty($site['instagram_url'])): ?>
                    <li class="list-inline-item"><a href="<?= htmlspecialchars($site['instagram_url']); ?>" target="_blank" class="text-light fs-5"><i class="fab fa-instagram"></i></a></li>
                <?php endif; ?>
                <?php if (!empty($site['linkedin_url'])): ?>
                    <li class="list-inline-item"><a href="<?= htmlspecialchars($site['linkedin_url']); ?>" target="_blank" class="text-light fs-5"><i class="fab fa-linkedin-in"></i></a></li>
                <?php endif; ?>
            </ul>
        </div>

        <!-- Copyright -->
        <div class="text-center border-top border-secondary pt-3">
            <p style="color:#aaa; font-size:14px; margin:0;">
                © 2025 <strong>TimeCore</strong>. All rights reserved. | 
                <span style="font-size:12px;">Educational purpose only. All product rights belong to their respective owners.</span>
            </p>
        </div>
    </div>
</footer>

<!-- Font Awesome (for icons) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- JS Files -->
<script src="assets/js/vendor/vendor.min.js"></script>
<script src="assets/js/plugins/plugins.min.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>
