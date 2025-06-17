<?php
include('../database/config.php'); // Include the config.php for DB credentials

session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION["email"])) {
    header("Location: ../Login/login.php"); // Correct the relative path
    exit();
}

try {
    // Prepare and execute the query to check if the user exists
    $stmt = $pdo->prepare("SELECT email FROM users WHERE email = :email");
    $stmt->bindParam(":email", $_SESSION["email"], PDO::PARAM_STR);
    $stmt->execute();

    // If the user does not exist, destroy session and redirect to login
    if (!$stmt->fetchColumn()) {
        session_destroy();
        header("Location: ../Login/login.php"); // Correct the relative path
        exit();
    }

    // Regenerate session ID for security
    session_regenerate_id(true);
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include "includes/head.php"; ?>
<?php include "includes/header.php"; ?>
<?php include "includes/nav.php"; ?>

<body>
<?php
$page = isset($_GET['p']) ? $_GET['p'] : 'dashboard';

switch ($page) {
    // Products
    case 'products_view':
        include 'view.php';
        break;
    case 'products_insert':
        include 'Add_Product.php';
        break;

    // Slider
    case 'slide_view':
        include 'view_slide.php';
        break;
    case 'slide_insert':
        include 'insert_slide.php';
        break;

    case 'edit_logo':
        include 'editlogo.php';
        break;
    case 'view_cat':
        include 'view_categories.php';
        break;
    case 'insert_cat':
        include 'insert_categories.php';
        break;
    

    // Default page (Dashboard)
    default:
        include 'dashboard.php';
        break;
}
?>

<?php include "includes/footer.php"; ?>
<?php include "includes/foot.php"; ?>

</body>
</html>
