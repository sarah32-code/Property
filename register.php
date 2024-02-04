<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT); // Encrypt password using bcrypt.

    // Set up your database connection. Replace placeholders with your actual database credentials.
    $dbHost = "localhost";
    $dbUsername = "smustafa2";
    $dbPassword = "smustafa2";
    $dbName = "smustafa2";

    $conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute an SQL INSERT query to save user data.
    $sql = "INSERT INTO users (first_name, last_name, email, username, password) 
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $firstName, $lastName, $email, $username, $password);

    if ($stmt->execute()) {
        // Registration successful.
        $stmt->close();
        $conn->close();

        // Redirect to a success page.
        header("Location: success.php");
        exit();
    } else {
        // Error handling (e.g., duplicate username or database error).
        $stmt->close();
        $conn->close();

        // Redirect to an error page or handle errors accordingly.
        header("Location: error.php");
        exit();
    }
}
?>
