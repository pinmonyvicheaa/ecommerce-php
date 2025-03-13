<!-- edit_slide.php -->
<?php
// Include database connection
include('../database/config.php');

// Check if the 'id' is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the slider data from the database
    try {
        $stmt = $pdo->prepare("SELECT * FROM sliders WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $slider = $stmt->fetch(PDO::FETCH_ASSOC);

        // If no slider is found, redirect to the view page
        if (!$slider) {
            header("Location: index.php?p=slide_view");
            exit;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit;
    }
}

// Check if the form is submitted
if (isset($_POST['edit'])) {
    // Retrieve form data
    $title = $_POST['tname'];
    $description = $_POST['sdesc'];

    // Handle file upload
    $image = $slider['image']; // Default image in case no new image is uploaded

    if (!empty($_FILES['simg']['name'])) {
        $target_dir = "../images/";
        $target_file = $target_dir . basename($_FILES["simg"]["name"]);
        $image = $_FILES['simg']['name'];

        // Move the uploaded file
        if (move_uploaded_file($_FILES["simg"]["tmp_name"], $target_file)) {
            // Image uploaded successfully, update the image in the database
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    // Update the slider in the database
    try {
        $stmt = $pdo->prepare("UPDATE sliders SET title = :title, image = :image, description = :description WHERE id = :id");
        $stmt->execute(['title' => $title, 'image' => $image, 'description' => $description, 'id' => $id]);

        // Redirect back to view page after successful edit
        header("Location: index.php?p=slide_view");
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "includes/head.php"; ?>
    <link rel="stylesheet" href="path/to/your/css/styles.css">
</head>

<body>
    <?php include "includes/header.php"; ?>
    <?php include "includes/nav.php"; ?>

    <div class="row">
        <div class="col-md-12 col-sm-12 lower-area mt-5 p-2">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">Edit Slider</h4>
                </div>

                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="row p-1">
                            <div class="col-md-6 col-sm-12">
                                <label for="tname">Title</label>
                                <input type="text" name="tname" value="<?php echo $slider['title']; ?>" placeholder="Enter Title Name" class="form-control" required>
                            </div>

                            <div class="col-md-6 col-sm-12">
                                <label for="sdesc">Description</label>
                                <textarea rows="3" placeholder="Enter Description" name="sdesc" class="form-control" required><?php echo $slider['description']; ?></textarea>
                            </div>

                            <div class="col-md-6 col-sm-12">
                                <label for="simg">Upload Slide Image</label>
                                <input type="file" name="simg" class="form-control-file">
                                <small>Current Image: <img src="../images/<?php echo $slider['image']; ?>" width="50" alt="Current Image"></small>
                            </div>

                            <div class="col-md-12 col-sm-12 mt-3">
                                <button type="submit" name="edit" value="edit" class="btn btn-primary">Edit Slider</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include "includes/footer.php"; ?>
</body>
</html>
