<?php
include('inc/header.php');
?>

<!-- Content Wrapper -->
<div class="content-wrapper">
  <!-- Page Header -->
  <section class="content-header">
    <div class="container-fluid text-center">
      <h1 class="display-4 font-weight-bold">About Us</h1>
      <p class="lead text-muted">Discover our journey, mission, and values</p>
    </div>
  </section>

  <!-- Main Content -->
  <section class="content">
    <div class="container-fluid">

      <!-- Who We Are -->
      <div class="card shadow-lg rounded-lg mb-4">
        <div class="card-body text-center">
          <h2 class="text-primary mb-3"><i class="fas fa-clock"></i> Who We Are</h2>
          <p class="text-muted">
            Welcome to <strong>TimeCore</strong>, your trusted destination for premium analog watches.
            We believe that a watch is more than just a timepiece — it’s a symbol of style,
            precision, and personality. Our curated collection is designed to suit every occasion,
            from everyday wear to luxury statements.
          </p>
        </div>
      </div>

      <!-- Mission & Vision -->
      <div class="row">
        <div class="col-md-6">
          <div class="card shadow-lg rounded-lg mb-4">
            <div class="card-body text-center">
              <h3 class="text-success mb-3"><i class="fas fa-bullseye"></i> Our Mission</h3>
              <p class="text-muted">
                To provide high-quality, stylish analog watches at affordable prices,
                blending tradition with modern trends to enhance your everyday lifestyle.
              </p>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="card shadow-lg rounded-lg mb-4">
            <div class="card-body text-center">
              <h3 class="text-info mb-3"><i class="fas fa-eye"></i> Our Vision</h3>
              <p class="text-muted">
                To become the most loved and trusted watch brand,
                inspiring people to value both time and timeless style.
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- Our Team -->
      <div class="card shadow-lg rounded-lg mb-4">
        <div class="card-body text-center">
          <h2 class="text-warning mb-3"><i class="fas fa-users"></i> Meet Our Team</h2>
          <div class="row">
            <div class="col-md-4">
              <img src="uploads/team1.jpg" class="rounded-circle mb-2" width="120" height="120" alt="Team Member">
              <h5>Bhavik Chauhan</h5>
              <p class="text-muted">Founder & CEO</p>
            </div>
            <div class="col-md-4">
              <img src="uploads/team2.jpg" class="rounded-circle mb-2" width="120" height="120" alt="Team Member">
              <h5>Karan Kuvadiya</h5>
              <p class="text-muted">Marketing Head</p>
            </div>
            <div class="col-md-4">
              <img src="uploads/team3.jpg" class="rounded-circle mb-2" width="120" height="120" alt="Team Member">
              <h5>Neha Sharma</h5>
              <p class="text-muted">Customer Support</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Contact CTA -->
      <div class="card shadow-lg rounded-lg bg-gradient-primary text-white text-center">
        <div class="card-body">
          <h3>Want to know more?</h3>
          <p>We’d love to hear from you. Feel free to explore our products or get in touch.</p>
          <a href="contact.php" class="btn btn-light btn-lg">
            <i class="fas fa-envelope"></i> Contact Us
          </a>
        </div>
      </div>

    </div>
  </section>
</div>

<?php
include('inc/footer.php');
?>
