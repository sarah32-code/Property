<?php
$servername = "localhost";
$username = "smustafa2";
$password = "smustafa2";
$database = "smustafa2";

// Create a database connection using the mysqli extension.
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection.
if ($conn->connect_error) {
    echo "Could not connect to server\n";
    die("Connection failed: " . $conn->connect_error);
}

// Set the character set to utf8 (optional).
$conn->set_charset("utf8");

// SQL to create properties table
$sqlCreateTable = "CREATE TABLE IF NOT EXISTS properties (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    property_name VARCHAR(100) NOT NULL,
    property_description TEXT,
    property_price DECIMAL(10, 2) NOT NULL,
    property_location VARCHAR(50),
    property_type VARCHAR(20),
    property_status VARCHAR(20)
)";

// Execute create table query for properties
if ($conn->query($sqlCreateTable) === TRUE) {
    echo "Table 'properties' created successfully\n";
} else {
    echo "Error creating table: " . $conn->error . "\n";
}

// SQL to create users table
$sqlCreateUsersTable = "CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    user_role ENUM('buyer', 'seller', 'admin') NOT NULL
)";

// Execute create table query for users
if ($conn->query($sqlCreateUsersTable) === TRUE) {
    echo "Table 'users' created successfully\n";
} else {
    echo "Error creating table: " . $conn->error . "\n";
}

// SQL to create wishlists table
$sqlCreateWishlistsTable = "CREATE TABLE IF NOT EXISTS wishlists (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT(6) UNSIGNED,
    property_id INT(6) UNSIGNED,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (property_id) REFERENCES properties(id)
)";

// Execute create table query for wishlists
if ($conn->query($sqlCreateWishlistsTable) === TRUE) {
    echo "Table 'wishlists' created successfully\n";
} else {
    echo "Error creating table: " . $conn->error . "\n";
}

// SQL to create credit_cards table (simplified)
$sqlCreateCreditCardsTable = "CREATE TABLE IF NOT EXISTS credit_cards (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    card_number VARCHAR(20) NOT NULL,
    cardholder_name VARCHAR(100) NOT NULL
)";

// Execute create table query for credit_cards
if ($conn->query($sqlCreateCreditCardsTable) === TRUE) {
    echo "Table 'credit_cards' created successfully\n";
} else {
    echo "Error creating table: " . $conn->error . "\n";
}

// Sample data for the 'users' table (you can add more users)
$sqlInsertUsersData = "INSERT INTO users (username, email, password, user_role) VALUES
('buyer1', 'buyer1@example.com', 'hashed_password', 'buyer'),
('seller1', 'seller1@example.com', 'hashed_password', 'seller'),
('admin1', 'admin1@example.com', 'hashed_password', 'admin')";

if ($conn->query($sqlInsertUsersData) === TRUE) {
    echo "Sample data inserted into 'users' table successfully\n";
} else {
    echo "Error inserting sample data: " . $conn->error . "\n";
}

// Sample data for the 'properties' table (you can add more listings)
$sqlInsertPropertiesData = "INSERT INTO properties (property_name, property_description, property_price, property_location, property_type, property_status) VALUES
('Property 1', 'Description for Property 1', 250000.00, 'Location 1', 'House', 'For Sale'),
('Property 2', 'Description for Property 2', 1800.00, 'Location 2', 'Apartment', 'For Rent')";

if ($conn->query($sqlInsertPropertiesData) === TRUE) {
    echo "Sample data inserted into 'properties' table successfully\n";
} else {
    echo "Error inserting sample data: " . $conn->error . "\n";
}

// Sample data for the 'wishlists' table (you can add more wishlists)
$sqlInsertWishlistsData = "INSERT INTO wishlists (user_id, property_id) VALUES
(1, 1),
(1, 2),
(2, 1)";

if ($conn->query($sqlInsertWishlistsData) === TRUE) {
    echo "Sample data inserted into 'wishlists' table successfully\n";
} else {
    echo "Error inserting sample data: " . $conn->error . "\n";
}

// Sample data for the 'credit_cards' table (simplified, you can modify as needed)
$sqlInsertCreditCardsData = "INSERT INTO credit_cards (card_number, cardholder_name) VALUES
('1111-2222-3333-4444', 'Cardholder 1')";

if ($conn->query($sqlInsertCreditCardsData) === TRUE) {
    echo "Sample data inserted into 'credit_cards' table successfully\n";
} else {
    echo "Error inserting sample data: " . $conn->error . "\n";
}

$conn->close();
?>
