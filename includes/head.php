<?php
require_once 'database/config.php'; // Include database connection

// Fetch the latest logo from the database
$stmt = $pdo->query("SELECT images FROM logo ORDER BY id DESC LIMIT 1");
$logo = $stmt->fetch(PDO::FETCH_ASSOC);
$logo_url = isset($logo['images']) ? 'images/' . $logo['images'] : 'images/placeholder-logo.png';

// Convert logo to favicon format (optional: create a resized favicon version)
$favicon_url = $logo_url; // Update this if you generate a separate favicon file
?>

<head>
    <title>ShopMax &mdash; Colorlib e-Commerce Template</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Dynamic Favicon (Logo as Favicon) -->
    <link rel="icon" href="<?= $favicon_url; ?>" type="image/x-icon">

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700"> 
    
    <!-- Icon Fonts -->
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/aos.css">

    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
