<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $enteredUsername = $_POST["username"];
    $enteredPassword = $_POST["password"];

    // Database connection setup (use consistent variable names).
    $dbHost = "localhost";
    $dbUsername = "smustafa2";
    $dbPassword = "smustafa2";
    $dbName = "smustafa2";

    $conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

    if ($conn->connect_error) {
        die("Database connection error: " . $conn->connect_error);
    }

    // Prepare and execute an SQL query to fetch user data based on the entered username.
    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $enteredUsername);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($userId, $dbUsername, $dbPasswordHash);
        $stmt->fetch();

        // Verify the entered password against the stored password hash.
        if (password_verify($enteredPassword, $dbPasswordHash)) {
            // Password is correct; log in the user.
            $_SESSION["user_id"] = $userId;
            $_SESSION["username"] = $dbUsername;
            header("Location: dashboard.php"); // Redirect to the user's dashboard.
            exit();
        } else {
            // Incorrect password; display an error message.
            $_SESSION["login_error"] = "Incorrect password.";
            header("Location: login.php"); // Redirect back to the login page.
            exit();
        }
    } else {
        // User with the entered username not found; display an error message.
        $_SESSION["login_error"] = "Username not found.";
        header("Location: login.php"); // Redirect back to the login page.
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    // Redirect to the login page if the request method is not POST.
    header("Location: login.php");
    exit();
}
?>
