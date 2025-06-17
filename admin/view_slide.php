<?php
include('../database/config.php'); // Include database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Slider</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container-fluid body-area mt-5">
        <div class="row">
            <div class="col-md-12 col-sm-12 view-area mt-2 p-1">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">View Slider</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive table-striped table-bordered w-100 d-block d-md-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Slide Image</th>
                                    <th>Slide Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                try {
                                    $stmt = $pdo->query("SELECT * FROM sliders");
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<tr>";
                                        echo "<td>{$row['id']}</td>";
                                        echo "<td>{$row['title']}</td>";
                                        echo "<td><img src='../images/{$row['image']}' alt='Slide Image' class='img-fluid' width='50'></td>";
                                        echo "<td>{$row['description']}</td>";
                                        echo "<td>
                                                <a href='edit_slide.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                                                <a href='delete_slide.php?id={$row['id']}' class='btn btn-danger btn-sm'>Delete</a>
                                              </td>";
                                        echo "</tr>";
                                    }
                                } catch (PDOException $e) {
                                    echo "Error: " . $e->getMessage();
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
