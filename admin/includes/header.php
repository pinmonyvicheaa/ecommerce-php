<body class="g-sidenav-show bg-gray-200">
  <?php $page = isset($_GET['p']) ? $_GET['p'] : 'dashboard'; ?>

  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="https://demos.creative-tim.com/material-dashboard/pages/dashboard" target="_blank">
        <img src="./assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-white">Material Dashboard 2</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse w-auto max-height-vh-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">

        <!-- Dashboard -->
        <li class="nav-item">
          <a class="nav-link text-white <?= ($page == 'dashboard') ? 'active bg-gradient-primary' : ''; ?>" href="index.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>

        <!-- Products -->
        <li class="nav-item">
          <a class="nav-link text-white <?= ($page == 'products_view') ? 'active bg-gradient-primary' : ''; ?>" href="index.php?p=products_view">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">inventory_2</i>
            </div>
            <span class="nav-link-text ms-1">View Products</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?= ($page == 'products_insert') ? 'active bg-gradient-primary' : ''; ?>" href="index.php?p=products_insert">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">add_box</i>
            </div>
            <span class="nav-link-text ms-1">Insert Product</span>
          </a>
        </li>

        <!-- Slider -->
        <li class="nav-item">
          <a class="nav-link text-white <?= ($page == 'slide_view') ? 'active bg-gradient-primary' : ''; ?>" href="index.php?p=slide_view">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">category</i>
            </div>
            <span class="nav-link-text ms-1">View Slide</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?= ($page == 'slide_insert') ? 'active bg-gradient-primary' : ''; ?>" href="index.php?p=slide_insert">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">playlist_add</i>
            </div>
            <span class="nav-link-text ms-1">Insert Slide</span>
          </a>
        </li>

        <!-- Other Pages -->
        <li class="nav-item">
          <a class="nav-link text-white <?= ($page == 'edit_logo') ? 'active bg-gradient-primary' : ''; ?>" href="index.php?p=edit_logo">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">receipt_long</i>
            </div>
            <span class="nav-link-text ms-1">Edit Logo</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?= ($page == 'view_cat') ? 'active bg-gradient-primary' : ''; ?>" href="index.php?p=view_cat">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">notifications</i>
            </div>
            <span class="nav-link-text ms-1">View Categories</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?= ($page == 'insert_cat') ? 'active bg-gradient-primary' : ''; ?>" href="index.php?p=insert_cat">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">notifications</i>
            </div>
            <span class="nav-link-text ms-1">Insert Categories</span>
          </a>
        </li>

        <!-- Account Pages -->
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account Pages</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?= ($page == 'profile') ? 'active bg-gradient-primary' : ''; ?>" href="index.php?p=profile">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">person</i>
            </div>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?= ($page == 'sign_in') ? 'active bg-gradient-primary' : ''; ?>" href="index.php?p=sign_in">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">login</i>
            </div>
            <span class="nav-link-text ms-1">Sign In</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?= ($page == 'sign_up') ? 'active bg-gradient-primary' : ''; ?>" href="index.php?p=sign_up">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">assignment</i>
            </div>
            <span class="nav-link-text ms-1">Sign Up</span>
          </a>
        </li>

      </ul>
    </div>
  </aside>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
