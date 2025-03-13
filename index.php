<?php
  $page = "home.php";
  $p = "home";
  $banner = true;
  $collections = true;
  $block = true;
  if(isset($_GET['p']))
  {
    $p = $_GET['p'];
    switch($p)
    {
      case "shop":
        $page = "shop.php";
        $banner = false;
        $collections = false;
        $block = false;
        break;
        case "about":
          $page = "about.php";
          $collections = false;
          $banner = false;
          $block = false;
          break;
      case "contact":
        $page = "contact.php";
        $collections = false;
        $banner = false;
        break;
        case "cart":
          $page = "cart.php";
          $collections = false;
          $banner = false;
          $block = false;
          break;
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<?php include "includes/head.php" ?>
  <body>
  <?php include "includes/header.php" ?>
  <?php if($banner) include "includes/banner.php" ?>
  <?php if($collections) include "includes/collections.php" ?>
  <?php include $page ?>
  <?php if($block) include "includes/block.php" ?>
  <?php include "includes/footer.php" ?>
    
  </body>
</html>