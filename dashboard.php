<?php
session_start();

// Check if the user is logged in. Redirect to the login page if not authenticated.
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// Include PHP file for database connection.
require_once("db_connection.php");

// Get user-specific data or perform required actions here.
$user_id = $_SESSION["user_id"];

// Example: Retrieve user information from the database based on the user_id.
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_assoc();
$stmt->close();

// Example: Display user-specific data on the dashboard.
$userName = $userData["username"];
$userEmail = $userData["email"];

?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
</head>
<body>
    <h2>Welcome, <?php echo $userName; ?>!</h2>
    
    <!-- Display user-specific content here based on your project's requirements. -->
    <div id="user-specific-content">
    <?php
    // Check the user's role (you should have a way to determine the user's role in your database).
    $userRole = $_SESSION["user_role"]; // Assuming you store the user's role in the session.

    if ($userRole === "buyer") {
        // Display content for buyers.
        echo "<h3>Buyer Dashboard</h3>";
        echo "<p>Welcome to the Buyer Dashboard. Here, you can search for properties and view your wishlist.</p>";
        echo "<a href='search_properties.php'>Search Properties</a>";
        echo "<a href='view_wishlist.php'>View Wishlist</a>";
    } elseif ($userRole === "seller") {
        // Display content for sellers.
        echo "<h3>Seller Dashboard</h3>";
        echo "<p>Welcome to the Seller Dashboard. Here, you can manage your listed properties.</p>";
        echo "<a href='manage_properties.php'>Manage Properties</a>";
    } elseif ($userRole === "admin") {
        // Display content for administrators.
        echo "<h3>Admin Dashboard</h3>";
        echo "<p>Welcome to the Admin Dashboard. Here, you can manage the platform and view analytics.</p>";
        echo "<a href='manage_users.php'>Manage Users</a>";
        echo "<a href='view_analytics.php'>View Analytics</a>";
    } else {
        // Handle unknown or unsupported user roles.
        echo "<p>Unsupported user role.</p>";
    }
    ?>
</div>
    <p>Email: <?php echo $userEmail; ?></p>
    
    <p><a href="logout.php">Log Out</a></p>
</body>
</html>
