<?php
include('inc/header.php');
include('inc/conn.php');

// Check if slider ID is provided
if(!isset($_GET['id'])){
    header("Location: slider_list.php");
    exit;
}

$id = intval($_GET['id']);

// Fetch the slider details
$res = mysqli_query($conn, "SELECT * FROM sliders WHERE id=$id");
$slider = mysqli_fetch_assoc($res);

if(!$slider){
    header("Location: slider_list.php");
    exit;
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $subtitle = mysqli_real_escape_string($conn, $_POST['subtitle']);
    $button_text = mysqli_real_escape_string($conn, $_POST['button_text']);
    $button_link = mysqli_real_escape_string($conn, $_POST['button_link']);

    // Update slider in database
    $update = "UPDATE sliders SET 
                title='$title', 
                subtitle='$subtitle', 
                button_text='$button_text', 
                button_link='$button_link' 
               WHERE id=$id";

    if(mysqli_query($conn, $update)){
        echo "<script>alert('Slider Updated Successfully');window.location='slider_list.php';</script>";
    } else {
        echo "<script>alert('Error updating slider');</script>";
    }
}
?>

<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid">
      <div class="card card-primary shadow-lg border-0">
        <div class="card-header bg-gradient-primary text-white">
          <h3 class="card-title"><i class="fas fa-edit"></i> Edit Slider</h3>
        </div>
        <form method="POST">
          <div class="card-body">
            <div class="form-group">
              <label>Title</label>
              <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($slider['title']) ?>" required>
            </div>
            <div class="form-group">
              <label>Subtitle</label>
              <input type="text" name="subtitle" class="form-control" value="<?= htmlspecialchars($slider['subtitle']) ?>" required>
            </div>
            <div class="form-group">
              <label>Button Text</label>
              <input type="text" name="button_text" class="form-control" value="<?= htmlspecialchars($slider['button_text']) ?>" required>
            </div>
            <div class="form-group">
              <label>Button Link</label>
              <input type="text" name="button_link" class="form-control" value="<?= htmlspecialchars($slider['button_link']) ?>" required>
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update Slider</button>
            <a href="slider_list.php" class="btn btn-secondary">Cancel</a>
          </div>
        </form>
      </div>
    </div>
  </section>
</div>

<?php include('inc/footer.php'); ?>
