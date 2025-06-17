<?php
include('../database/config.php'); // Include the config.php for DB credentials

session_start();
$text = "";
try {
    // Your database connection is in place here
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":email", $username, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $password === $user['password']) {
        $_SESSION["email"] = $username;
        header("Location: ../admin/index.php"); // Correct the relative path
        exit;
    } else {
        $text = "<span class='text-danger'>Incorrect email or password</span>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../admin/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../admin/assets/img/favicon.png">
    <title>Admin</title>
    <link href="../admin/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../admin/assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link id="pagestyle" href="../admin/assets/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />
</head>
<body class="bg-gray-200">
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <nav class="navbar navbar-expand-lg blur border-radius-xl top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
          <div class="container-fluid ps-2 pe-0">
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="#">Admin</a>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </span>
            </button>
            <div class="collapse navbar-collapse" id="navigation">
              <ul class="navbar-nav mx-auto">
                  <a class="nav-link me-2" href="#">
                    <i class="fas fa-key opacity-6 text-dark me-1"></i>
                    Sign In
                  </a>
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </div>

  <main class="main-content mt-0">
    <div class="page-header align-items-start min-vh-100" style="background-image: url('../images/background.jpg');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-4 col-md-8 col-12 mx-auto">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                  <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Sign in</h4>
                </div>
              </div>
              <div class="card-body">
                <form method="POST" action="">
                  <div class="input-group input-group-outline my-3">
                    <label class="form-label"></label>
                    <input type="email" class="form-control" name="email" placeholder="email" value="admin@gmail.com" required>
                  </div>
                  <div class="input-group input-group-outline mb-3">
                    <label class="form-label"></label>
                    <input type="password" class="form-control" name="password" placeholder="password" value="admin" required>
                  </div>
                  <div class="form-check form-switch d-flex align-items-center mb-3">
                    <input class="form-check-input" type="checkbox" id="customCheck">
                    <label class="form-check-label mb-0 ms-2" for="customCheck">Remember me</label>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Sign in</button>
                  </div>
                  <?php echo $text; ?>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="../admin/assets/js/core/popper.min.js"></script>
  <script src="../admin/assets/js/core/bootstrap.min.js"></script>
  <script src="../admin/assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../admin/assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = { damping: '0.5' };
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script src="../admin/assets/js/material-dashboard.min.js?v=3.0.0"></script>
</body>
</html>
