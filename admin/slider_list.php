<?php
include('inc/header.php');
include('inc/conn.php');

$result = mysqli_query($conn, "SELECT * FROM sliders ORDER BY id DESC");
?>

<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid">
      <div class="card shadow-lg border-0">
        <div class="card-header bg-gradient-primary text-white">
          <h3 class="card-title"><i class="fas fa-images"></i> Slider List</h3>
        </div>
        <div class="card-body">
          <table class="table table-bordered table-hover text-center">
            <thead class="bg-dark text-white">
              <tr>
                <th>#</th>
                <th>Image</th>
                <th>Title</th>
                <th>Subtitle</th>
                <th>Status</th>
                <th>Action</th> 
              </tr>
            </thead>
            <tbody>
              <?php
              if (mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {

                      // fix image path (store only filename in DB)
                      $imagePath = 'uploads/sliders/' . basename($row["image"]);

                      echo "<tr>
                              <td>{$row['id']}</td>
                              <td><img src='{$imagePath}' width='120' style='border-radius:8px;'></td>
                              <td>{$row['title']}</td>
                              <td>{$row['subtitle']}</td>";

                      echo "<td>
                              <a href='toggle_slider.php?id={$row['id']}' 
                              class='btn btn-sm " . ($row['status'] ? "btn-success" : "btn-secondary") . "' 
                              onclick=\"return confirm('Are you sure you want to change this slider status?');\">
                              " . ($row['status'] ? "Active" : "Inactive") . "
                              </a>
                            </td>";

                      echo "<td>
                              <a href='edit_slider.php?id={$row['id']}' class='btn btn-sm btn-warning me-1'>
                                <i class='fas fa-edit'></i> Edit
                              </a>
                              <a href='delete_slider.php?id={$row['id']}' class='btn btn-sm btn-danger' 
                                 onclick=\"return confirm('Are you sure you want to delete this slider?');\">
                                <i class='fas fa-trash'></i> Delete
                              </a>
                            </td>";

                      echo "</tr>";
                  }
              } else {
                  echo "<tr><td colspan='6'>No Sliders Found</td></tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</div>

<?php include('inc/footer.php'); ?>
