<?php
include('../database/config.php'); // Include database connection

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $title = $_POST['tname'];
    $description = $_POST['sdesc'];

    // Handle the file upload
    $image = $_FILES['simg']['name'];
    $target_dir = "../images/";
    $target_file = $target_dir . basename($_FILES["simg"]["name"]);

    // Move the uploaded file to the desired directory
    if (move_uploaded_file($_FILES["simg"]["tmp_name"], $target_file)) {
        try {
            // Insert the slide data into the database
            $stmt = $pdo->prepare("INSERT INTO sliders (title, description, image) VALUES (:title, :description, :image)");
            $stmt->execute(['title' => $title, 'description' => $description, 'image' => $image]);

            // Redirect to the view page after successful insertion
            header("Location: index.php?p=slide_view");
            exit;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Error uploading the file.";
    }
}
?>

<!-- HTML Form: Insert Slider (Form is processed by the same PHP script above) -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Slider</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container-fluid body-area mt-5">
        <div class="row mt-3">
            <div class="col-md-12 col-sm-12 lower-area mt-5 p-2">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">Add Slider</h4>
                    </div>
                    <div class="card-body">
                        <form action="insert_slide.php" method="POST" enctype="multipart/form-data">
                            <div class="row p-1">
                                <div class="col-md-6 col-sm-12">
                                    <label for="tname">Title Name</label>
                                    <input type="text" id="tname" name="tname" placeholder="Enter Title Name"
                                           class="form-control" required>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label for="sdesc">Description</label>
                                    <textarea rows="3" id="sdesc" placeholder="Enter Description" name="sdesc"
                                              class="form-control" required></textarea>
                                </div>
                                <div class="col-md-6 col-sm-12 mt-3">
                                    <label for="simg">Upload Slide Image</label>
                                    <input type="file" id="simg" name="simg" class="form-control-file" required>
                                </div>

                                <div class="col-md-12 col-sm-12 mt-3">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
