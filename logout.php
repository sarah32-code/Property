<?php
// Start or resume the session.
session_start();

// Check if the user is logged in.
if (isset($_SESSION["user_id"])) {
    // Unset all session variables.
    session_unset();

    // Destroy the session.
    session_destroy();
}

// Redirect to the login page or any desired page after logout.
header("Location: login.php");
exit();
?>
