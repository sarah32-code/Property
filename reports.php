<?php
session_start();

// Check if the user is logged in and has admin privileges. Redirect if not.
if (!isset($_SESSION["user_id"]) || $_SESSION["user_role"] !== "admin") {
    header("Location: login.php");
    exit();
}

// Include PHP file for database connection.
require_once("db_connection.php");

// Function to fetch and display reports
function fetchReports($conn) {
    // You should implement your logic to fetch reports from the database here.
    // For this example, we'll assume that you have a 'reports' table with fields 'report_id' and 'report_name'.
    $query = "SELECT report_id, report_name FROM reports";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Report ID</th><th>Report Name</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["report_id"] . "</td>";
            echo "<td>" . $row["report_name"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No reports available.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Reports</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
    <h2>Admin Reports</h2>

    <!-- Display reports using the fetchReports function -->
    <?php
    fetchReports($conn);
    ?>

    <p><a href="admin_dashboard.php">Back to Admin Dashboard</a></p>
</body>

</html>
