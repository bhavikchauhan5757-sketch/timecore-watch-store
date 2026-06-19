<?php
include('inc/header.php');
include('inc/conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $button_text = $_POST['button_text'];
    $button_link = $_POST['button_link'];

    // File Upload
    $targetDir = "uploads/sliders/";  
    if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);

    $fileName = basename($_FILES["image"]["name"]);
    $newFileName = time() . "_" . $fileName;   // only filename with timestamp
    $targetFilePath = $targetDir . $newFileName;

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
        // Store only the filename in the database
        $sql = "INSERT INTO sliders (image, title, subtitle, button_text, button_link, status) 
                VALUES ('$newFileName', '$title', '$subtitle', '$button_text', '$button_link', 1)";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Slider Added Successfully');window.location='slider_list.php';</script>";
        } else {
            echo "<script>alert('Error: Could not save slider');</script>";
        }
    } else {
        echo "<script>alert('Image Upload Failed');</script>";
    }
}
?>

<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Add Slider</h3>
        </div>
        <form method="POST" enctype="multipart/form-data">
          <div class="card-body">
            <div class="form-group">
              <label>Slider Image</label>
              <input type="file" name="image" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Title</label>
              <input type="text" name="title" class="form-control">
            </div>
            <div class="form-group">
              <label>Subtitle</label>
              <input type="text" name="subtitle" class="form-control">
            </div>
            <div class="form-group">
              <label>Button Text</label>
              <input type="text" name="button_text" class="form-control" value="Shop Now">
            </div>
            <div class="form-group">
              <label>Button Link</label>
              <input type="text" name="button_link" class="form-control" value="product.php">
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Add Slider</button>
          </div>
        </form>
      </div>
    </div>
  </section>
</div>

<?php include('inc/footer.php'); ?>
