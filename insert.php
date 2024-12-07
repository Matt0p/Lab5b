<?php
include 'database.php'; // Include your database connection logic
include 'user.php'; // Include the User class

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $role = $_POST['role'];
    $password = $_POST['password'];

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Connect to the database
    $database = new database();
    $db = $database->getConnection();

    // Initialize User object
    $user = new user($db);

    // Insert data into the database
    if ($user->register($matric, $name, $role, $hashedPassword)) {
        // On successful registration, redirect to login.php
        header("Location: login.php");
        exit(); // Stop further script execution
    } else {
        echo "Failed to register user. Please try again.";
    }

    // Close the database connection
    $db->close();
}
?>
