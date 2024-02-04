<?php
session_start();

// Check if the user is logged in. Redirect to the login page if not authenticated.
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// Include PHP file for database connection.
require_once("db_connection.php");

// Check if this is the buyer's first login
$firstLogin = false; // Set this based on your logic to detect first login

if ($firstLogin) {
    // Display a creative welcome note for the first login
    echo "<h2>Welcome to Your Buyer Dashboard!</h2>";
    echo "<p>Thank you for choosing us. Start exploring properties or create your wishlist.</p>";
}

// Search properties based on user input (adjust this based on your search logic)
if (isset($_GET["search"])) {
    $searchTerm = $_GET["search"];
    // Implement your search query here and fetch the matching properties
    $query = "SELECT * FROM properties WHERE property_name LIKE ? OR property_location LIKE ?";
    $stmt = $conn->prepare($query);
    $searchTerm = "%" . $searchTerm . "%";
    $stmt->bind_param("ss", $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    // If no search term provided, display all properties
    $query = "SELECT * FROM properties";
    $result = $conn->query($query);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Buyer Dashboard</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h2>Buyer Dashboard</h2>

    <!-- Search Bar -->
    <form id="searchForm" method="GET" action="buyer_dashboard.php">
        <input type="text" id="search" name="search" placeholder="Search properties">
        <button type="submit">Search</button>
    </form>

    <!-- Property Cards -->
    <div class="property-cards">
        <?php
        while ($propertyData = $result->fetch_assoc()) {
            // Display property cards for each property
            echo "<div class='property-card'>";
            echo "<h3>" . $propertyData["property_name"] . "</h3>";
            echo "<p>Location: " . $propertyData["property_location"] . "</p>";
            // Display other property details as needed
            echo "<a href='property_details.php?property_id=" . $propertyData["id"] . "'>View Details</a>";
            echo "<button onclick='addToWishlist(" . $propertyData["id"] . ")'>Add to Wishlist</button>";
            echo "</div>";
        }
        ?>
    </div>

    <h3>Your Wishlist</h3>
    <!-- Display the user's wishlist properties here (implement this part based on your logic) -->

    <p><a href="logout.php">Log Out</a></p>

    <script src="buyer_dashboard.js"></script>
</body>
</html>
