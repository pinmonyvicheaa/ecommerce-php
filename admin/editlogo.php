<?php
require_once '../database/config.php'; // Include database connection

// Fetch the latest logo from the database
$stmt = $pdo->query("SELECT images FROM logo ORDER BY id DESC LIMIT 1");
$logo = $stmt->fetch(PDO::FETCH_ASSOC);
$logo_url = isset($logo['images']) ? '../images/' . $logo['images'] : '../images/placeholder-logo.png';

// Handle logo upload
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['logo'])) {
    $target_dir = "../images/"; // Directory to store images
    $file_name = basename($_FILES["logo"]["name"]);
    $target_file = $target_dir . $file_name;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check file type
    $allowed_types = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($imageFileType, $allowed_types)) {
        echo "<script>alert('Invalid file type! Only JPG, JPEG, PNG & GIF allowed.');</script>";
    } else {
        if (move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file)) {
            // Delete the previous logo file from the folder
            if (!empty($logo['images']) && file_exists("../images/" . $logo['images'])) {
                unlink("../images/" . $logo['images']); // Remove the old file
            }

            // Delete the old logo record from the database
            $stmt = $pdo->prepare("DELETE FROM logo");
            $stmt->execute();

            // Insert the new logo into the database
            $stmt = $pdo->prepare("INSERT INTO logo (images) VALUES (?)");
            $stmt->execute([$file_name]);

            echo "<script>alert('Logo updated successfully!'); window.location.href='index.php?p=edit_logo';</script>";
        } else {
            echo "<script>alert('Error uploading file.');</script>";
        }
    }
}
?>

<div class="container mt-5">
  <h2>Edit Logo</h2>

  <!-- Display current logo -->
  <div class="row">
    <div class="col-md-6">
      <h5>Current Logo</h5>
      <img id="current-logo" src="<?= $logo_url; ?>" alt="Current Logo" class="img-fluid" />
    </div>
  </div>

  <!-- Form to upload a new logo -->
  <form action="index.php?p=edit_logo" method="POST" enctype="multipart/form-data">
    <div class="form-group mt-3">
      <label for="logoUpload">Upload New Logo</label>
      <input type="file" class="form-control-file" id="logoUpload" name="logo" required>
    </div>
    <button type="submit" class="btn btn-primary">Update Logo</button>
  </form>
</div>
