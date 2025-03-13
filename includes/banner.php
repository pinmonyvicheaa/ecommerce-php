<!-- banner.php -->
<?php
// Include database connection
include('database/config.php');

// Fetch all slider data for the carousel
try {
    $stmt = $pdo->query("SELECT * FROM sliders");
    $sliders = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}
?>

<div id="bannerCarousel" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <?php
    // Loop through the sliders and generate carousel items
    $active = 'active'; // Set the first item as active
    foreach ($sliders as $slider) {
        echo "<div class='carousel-item $active'>";
        echo "<div class='site-blocks-cover' data-aos='fade'>";
        echo "<div class='container'>";
        echo "<div class='row'>";
        echo "<div class='col-md-6 ml-auto order-md-2 align-self-start'>";
        echo "<div class='site-block-cover-content'>";
        echo "<h2 class='sub-title'>#{$slider['title']}</h2>";
        echo "<h1>{$slider['description']}</h1>";
        echo "<p><a href='#' class='btn btn-black rounded-0'>Shop Now</a></p>";
        echo "</div>";
        echo "</div>";
        echo "<div class='col-md-6 order-1 align-self-end'>";
        echo "<img src='images/{$slider['image']}' alt='Image' class='img-fluid'>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";

        // After the first iteration, change active class for next items
        $active = '';
    }
    ?>
  </div>

  <!-- Controls -->
  <a class="carousel-control-prev" href="#bannerCarousel" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#bannerCarousel" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<!-- Bootstrap Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
