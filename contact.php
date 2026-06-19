<?php
    include('inc/header.php');
?>

<!-- ...:::: Start Breadcrumb Section:::... -->
    <div class="breadcrumb-section breadcrumb-bg-color--golden">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="breadcrumb-title">Contact Us</h3>
                        <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li><a href="index.php">Home</a></li>
                                    <li class="active" aria-current="page">Contact Us</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- ...:::: End Breadcrumb Section:::... -->

    <!-- ...::::Start Contact Section:::... -->
    <div class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <?php
include('inc/conn.php');

// Fetch site settings from database
$query = mysqli_query($conn, "SELECT * FROM site_settings LIMIT 1");
$site = mysqli_fetch_assoc($query);
?>

<!-- ✅ Make sure Font Awesome is included -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<!-- Start Contact Details -->
<div class="contact-details-wrapper section-top-gap-100" data-aos="fade-up" data-aos-delay="0">
    <div class="contact-details">

        <!-- 📞 Phone -->
        <?php if (!empty($site['phone_number'])): ?>
        <div class="contact-details-single-item">
            <div class="contact-details-icon">
                <i class="fa-solid fa-phone"></i>
            </div>
            <div class="contact-details-content contact-phone">
                <a href="tel:<?php echo htmlspecialchars($site['phone_number']); ?>">
                    <?php echo htmlspecialchars($site['phone_number']); ?>
                </a>
            </div>
        </div>
        <?php endif; ?>

        <!-- 🌐 Email + Website -->
        <div class="contact-details-single-item">
            <div class="contact-details-icon">
                <i class="fa-solid fa-globe"></i>
            </div>
            <div class="contact-details-content contact-phone">
                <?php if (!empty($site['email_address'])): ?>
                    <a href="mailto:<?php echo htmlspecialchars($site['email_address']); ?>">
                        <?php echo htmlspecialchars($site['email_address']); ?>
                    </a><br>
                <?php endif; ?>

                <?php if (!empty($site['website_url'])): ?>
                    <a href="<?php echo htmlspecialchars($site['website_url']); ?>" target="_blank">
                        <?php echo htmlspecialchars($site['website_url']); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <!-- 📍 Address -->
        <?php if (!empty($site['business_address'])): ?>
        <div class="contact-details-single-item">
            <div class="contact-details-icon">
                <i class="fa-solid fa-location-dot"></i>
            </div>
            <div class="contact-details-content contact-phone">
                <span><?php echo htmlspecialchars($site['business_address']); ?></span>
            </div>
        </div>
        <?php endif; ?>

    </div>

    <!-- 📲 Social Media Links -->
    <div class="contact-social">
        <h4>Follow Us</h4>
        <ul>
            <?php if (!empty($site['facebook_url'])): ?>
                <li><a href="<?php echo htmlspecialchars($site['facebook_url']); ?>" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
            <?php endif; ?>

            <?php if (!empty($site['twitter_url'])): ?>
                <li><a href="<?php echo htmlspecialchars($site['twitter_url']); ?>" target="_blank"><i class="fa-brands fa-twitter"></i></a></li>
            <?php endif; ?>

            <?php if (!empty($site['google_url'])): ?>
                <li><a href="<?php echo htmlspecialchars($site['google_url']); ?>" target="_blank"><i class="fa-brands fa-google-plus-g"></i></a></li>
            <?php endif; ?>

            <?php if (!empty($site['instagram_url'])): ?>
                <li><a href="<?php echo htmlspecialchars($site['instagram_url']); ?>" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
            <?php endif; ?>

            <?php if (!empty($site['linkedin_url'])): ?>
                <li><a href="<?php echo htmlspecialchars($site['linkedin_url']); ?>" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a></li>
            <?php endif; ?>
        </ul>
    </div>
</div>
<!-- End Contact Details -->

                </div>
                <div class="col-lg-8">
                    <div class="contact-form section-top-gap-100" data-aos="fade-up" data-aos-delay="200">
                        <h3>Get In Touch</h3>
<form action="contact_process.php" method="post">
    <div class="default-form-box mb-20">
        <label for="contact-name">Name</label>
        <input name="name" type="text" id="contact-name" required>
    </div>

    <div class="default-form-box mb-20">
        <label for="contact-email">Email</label>
        <input name="email" type="email" id="contact-email" required>
    </div>

    <div class="default-form-box mb-20">
        <label for="contact-subject">Subject</label>
        <input name="subject" type="text" id="contact-subject">
    </div>

    <div class="default-form-box mb-20">
        <label for="contact-message">Your Message</label>
        <textarea name="message" id="contact-message" cols="30" rows="10" required></textarea>
    </div>

    <input type="submit" value="submit">
</form>

<?php
// Display success/error messages if redirected
if (isset($_GET['success']) && $_GET['success'] != '') {
    echo '<p class="success-message">'.htmlspecialchars($_GET['success']).'</p>';
}
if (isset($_GET['error']) && $_GET['error'] != '') {
    echo '<p class="error-message">'.htmlspecialchars($_GET['error']).'</p>';
}
?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ...::::ENd Contact Section:::... -->

<?php
    include('inc/footer.php');
?>