<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include('inc/conn.php');

$check = mysqli_query($conn, "SELECT * FROM site_settings LIMIT 1");
if (mysqli_num_rows($check) == 0) {
    mysqli_query($conn, "INSERT INTO site_settings (site_name) VALUES ('My Website')");
}

$query = mysqli_query($conn, "SELECT * FROM site_settings LIMIT 1");
$data = mysqli_fetch_assoc($query);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $site_name = mysqli_real_escape_string($conn, $_POST['site_name']);
    $business_address = mysqli_real_escape_string($conn, $_POST['business_address']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $email_address = mysqli_real_escape_string($conn, $_POST['email_address']);
    $facebook_url = mysqli_real_escape_string($conn, $_POST['facebook_url']);
    $twitter_url = mysqli_real_escape_string($conn, $_POST['twitter_url']);
    $instagram_url = mysqli_real_escape_string($conn, $_POST['instagram_url']);

    $update_logo = '';

    if (!empty($_FILES['website_logo']['name'])) {
        $logo_name = time() . '_' . basename($_FILES['website_logo']['name']);
        $logo_tmp = $_FILES['website_logo']['tmp_name'];
        $upload_dir = "../assets/images/logo/" . $logo_name;

        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];
        $ext = strtolower(pathinfo($logo_name, PATHINFO_EXTENSION));

        if (in_array($ext, $allowed_ext)) {
            if (move_uploaded_file($logo_tmp, $upload_dir)) {
                $update_logo = ", website_logo='$logo_name'";
            } else {
                $_SESSION['error'] = "Failed to upload logo. Please check folder permissions.";
            }
        } else {
            $_SESSION['error'] = "Invalid logo format. Only JPG, PNG, GIF allowed.";
        }
    }

    if (!isset($_SESSION['error'])) {
        // ✅ Fixed: prevent dangling comma issue
        $update = "UPDATE site_settings SET 
                   site_name='$site_name',
                   business_address='$business_address',
                   phone_number='$phone_number',
                   email_address='$email_address',
                   facebook_url='$facebook_url',
                   twitter_url='$twitter_url',
                   instagram_url='$instagram_url'";

        if (!empty($update_logo)) {
            $update .= $update_logo;
        }

        $update .= ", updated_at=NOW() LIMIT 1";

        if (mysqli_query($conn, $update)) {
            $_SESSION['success'] = "Settings updated successfully!";
        } else {
            $_SESSION['error'] = "Database update failed: " . mysqli_error($conn);
        }

        header("Location: site_setting.php");
        exit;
    }
}

include('inc/header.php');
?>

<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Site Settings</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Site Settings</li>
          </ol>
        </div>
      </div>
    </div>
  </section>


  <section class="content">
    <div class="container-fluid">
      <div class="row">

        <div class="col-md-8">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Website Configuration</h3>
            </div>

            <form method="POST" enctype="multipart/form-data">
              <div class="card-body">

                <?php
                if (isset($_SESSION['success'])) {
                    echo '<p class="alert alert-success">'.$_SESSION['success'].'</p>';
                    unset($_SESSION['success']);
                }
                if (isset($_SESSION['error'])) {
                    echo '<p class="alert alert-danger">'.$_SESSION['error'].'</p>';
                    unset($_SESSION['error']);
                }
                ?>

                <h5><i class="fas fa-info-circle"></i> Basic Information</h5>
                <div class="form-group">
                  <label>Site Name</label>
                  <input type="text" name="site_name" class="form-control" value="<?= htmlspecialchars($data['site_name']) ?>" required>
                </div>

                <div class="form-group">
                  <label>Business Address</label>
                  <textarea name="business_address" class="form-control" rows="2"><?= htmlspecialchars($data['business_address']) ?></textarea>
                </div>

                <h5 class="mt-3"><i class="fas fa-phone"></i> Contact Information</h5>
                <div class="form-group">
                  <label>Phone Number</label>
                  <input type="text" name="phone_number" class="form-control" value="<?= htmlspecialchars($data['phone_number']) ?>">
                </div>

                <div class="form-group">
                  <label>Email Address</label>
                  <input type="email" name="email_address" class="form-control" value="<?= htmlspecialchars($data['email_address']) ?>">
                </div>

                <h5 class="mt-3"><i class="fas fa-image"></i> Brand Identity</h5>
                <div class="form-group">
                  <label>Website Logo</label><br>
                  <?php if (!empty($data['website_logo'])) { ?>
                      <img src="../assets/images/logo/<?= htmlspecialchars($data['website_logo']) ?>" height="60" class="border mb-2">
                  <?php } ?>
                  <input type="file" name="website_logo" class="form-control">
                  <small class="text-muted">Upload PNG/JPG/GIF only.</small>
                </div>

                <h5 class="mt-3"><i class="fas fa-share-alt"></i> Social Media Links</h5>
                <div class="form-group">
                  <label>Facebook URL</label>
                  <input type="url" name="facebook_url" class="form-control" value="<?= htmlspecialchars($data['facebook_url']) ?>">
                </div>

                <div class="form-group">
                  <label>Twitter URL</label>
                  <input type="url" name="twitter_url" class="form-control" value="<?= htmlspecialchars($data['twitter_url']) ?>">
                </div>

                <div class="form-group">
                  <label>Instagram URL</label>
                  <input type="url" name="instagram_url" class="form-control" value="<?= htmlspecialchars($data['instagram_url']) ?>">
                </div>

              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Settings</button>
              </div>
            </form>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Current Settings</h3>
            </div>
            <div class="card-body text-center">
              <?php if (!empty($data['website_logo'])) { ?>
                  <img src="../assets/images/logo/<?= htmlspecialchars($data['website_logo']) ?>" width="100" class="mb-2 border rounded"><br>
              <?php } ?>
              <h5><?= htmlspecialchars($data['site_name']) ?></h5>
              <p><i class="fas fa-phone"></i> <?= htmlspecialchars($data['phone_number']) ?></p>
              <p><i class="fas fa-envelope"></i> <?= htmlspecialchars($data['email_address']) ?></p>
              <p><i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars($data['business_address']) ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php include('inc/footer.php'); ?>
