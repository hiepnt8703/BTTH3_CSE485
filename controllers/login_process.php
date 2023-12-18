<?php
// Start the session
session_start();

// Include config file
require_once 'config.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        // Database connection
        $dbh = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // SQL query to check the username and password
        $query = "SELECT id, name FROM users WHERE username = :username AND password = :password";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->execute();

        // Check if there is a match
        if ($stmt->rowCount() == 1) {
            // Fetch user data
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set session variables
            $_SESSION["user_id"] = $user['id'];
            $_SESSION["name"] = $user['name'];

            // Redirect to the dashboard or another page
            header("Location: dashboard.php");
            exit();
        } else {
            // Display an error message if no match is found
            echo "Invalid username or password";
        }
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    } finally {
        // Close the database connection
        $dbh = null;
    }
}
?>
