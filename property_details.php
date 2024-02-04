<?php
session_start();

// Check if the user is logged in. Redirect to the login page if not authenticated.
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// Include PHP file for database connection.
require_once("db_connection.php");

// Get the property ID from the URL (adjust this based on your URL structure).
if (isset($_GET["property_id"])) {
    $propertyId = $_GET["property_id"];
} else {
    // Handle the case where property_id is not provided in the URL.
    // You can display an error message or redirect to another page.
    header("Location: dashboard.php"); // Redirect to the dashboard.
    exit();
}

// Fetch property details based on the property ID.
$query = "SELECT * FROM properties WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $propertyId);
$stmt->execute();
$result = $stmt->get_result();
$propertyData = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Property Details</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script src="property_details.js"></script>
</head>
<body>
    <h2>Property Details</h2>
    <div class="container">
        <!-- Display property details here -->
        <h3>Location: <?php echo $propertyData["property_location"]; ?></h3>
        <p>Age: <?php echo $propertyData["property_age"]; ?></p>
        <!-- Display other property details as needed -->

        <!-- Update Property Form -->
        <form id="updateForm">
            <h3>Update Property Details</h3>
            <!-- Include input fields for updating property details -->
            <!-- Example: <input type="text" id="locationField" name="location" placeholder="Location" required><br> -->
            <!-- You can add more input fields here as needed -->
            <button type="button" id="updateButton">Update</button>
        </form>

        <!-- Delete Property Button -->
        <button type="button" id="deleteButton">Delete Property</button>
    </div>

    <p><a href="dashboard.php">Back to Dashboard</a></p>
    
    <script>
        // Initialize property details and actions when the page loads
        window.addEventListener('load', function () {
            // Initialize property details using PHP data
            const propertyDetails = <?php echo json_encode($propertyData); ?>;
            // Example: document.getElementById('locationField').value = propertyDetails.property_location;
            
            // Set the property ID for JavaScript functions
            const propertyId = <?php echo $propertyId; ?>;
            
            // Call the JavaScript function to handle property details, updates, and deletions
            initializePropertyDetails(propertyDetails, propertyId);
        });
    </script>
</body>
</html>
