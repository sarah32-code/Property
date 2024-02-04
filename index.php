<?php
session_start();

if (!isset($_SESSION["admin_id"])) {
    header("Location: login.php");
    exit();
}

include_once("includes/header.php");
?>

<!-- Admin Dashboard Content -->
<div class="dashboard-content">
    <h2>Welcome to Admin Dashboard</h2>
    <!-- Add various widgets and panels here -->
</div>

<?php include_once("includes/footer.php"); ?>
