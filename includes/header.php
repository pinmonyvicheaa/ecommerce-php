<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once 'database/config.php'; // Include database connection



// Fetch latest logo from the database
$stmt = $pdo->query("SELECT images FROM logo ORDER BY id DESC LIMIT 1");
$logo = $stmt->fetch(PDO::FETCH_ASSOC);
$logo_url = isset($logo['images']) ? 'images/' . $logo['images'] : 'images/placeholder-logo.png';

// Get cart count
$cart_count = isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'quantity')) : 0;
?>

<!-- Header -->
<div class="site-wrap">
    <div class="site-navbar bg-white py-2">
        <div class="search-wrap">
            <div class="container">
                <a href="#" class="search-close js-search-close"><span class="icon-close2"></span></a>
                <form action="index.php?p=search" method="GET">
                    <input type="text" name="q" class="form-control" placeholder="Search keyword and hit enter...">
                </form>  
            </div>
        </div>

        <div class="container">
            <div class="d-flex align-items-center justify-content-between">
                <!-- Logo -->
                <div class="logo">
                    <div>
                        <a href="index.php">
                            <img src="<?= $logo_url; ?>" alt="Logo" class="img-fluid" width="100">
                        </a>
                    </div>
                </div>

                <!-- Navigation -->
                <div class="main-nav d-none d-lg-block">
                    <nav class="site-navigation text-right text-md-center" role="navigation">
                        <ul class="site-menu js-clone-nav d-none d-lg-block">
                            <li class="<?= (isset($p) && $p == 'home') ? 'active' : '' ?>">
                                <a href="index.php">Home</a>
                            </li>
                            <li class="<?= (isset($p) && $p == 'shop') ? 'active' : '' ?>">
                                <a href="index.php?p=shop">Shop</a>
                            </li>
                            <li><a href="#">Catalogue</a></li>
                            <li><a href="#">New Arrivals</a></li>
                            <li class="<?= (isset($p) && $p == 'about') ? 'active' : '' ?>">
                                <a href="index.php?p=about">About</a>
                            </li>
                            <li class="<?= (isset($p) && $p == 'contact') ? 'active' : '' ?>">
                                <a href="index.php?p=contact">Contact</a>
                            </li>
                        </ul>
                    </nav>
                </div>

                <!-- Icons (Search, Wishlist, Cart, Mobile Menu) -->
                <div class="icons">
                    <a href="#" class="icons-btn d-inline-block js-search-open">
                        <span class="icon-search"></span>
                    </a>
                    <a href="#" class="icons-btn d-inline-block">
                        <span class="icon-heart-o"></span>
                    </a>
                    <a href="index.php?p=cart" class="icons-btn d-inline-block bag">
                        <span class="icon-shopping-bag"></span>
                        <span class="number"><?= $cart_count; ?></span>
                    </a>
                    <a href="#" class="site-menu-toggle js-menu-toggle ml-3 d-inline-block d-lg-none">
                        <span class="icon-menu"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
