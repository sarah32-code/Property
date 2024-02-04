<?php
session_start();

if (!isset($_SESSION["admin_id"])) {
    header("Location: login.php");
    exit();
}

include_once("includes/header.php");
?>

<!-- User Management Content -->
<div class="dashboard-content">
    <h2>User Management</h2>
    <!-- List of users and actions -->
</div>

<?php include_once("includes/footer.php"); ?>
