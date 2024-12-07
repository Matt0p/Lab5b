

<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
include 'database.php';
include 'user.php';

// Check if the form is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $role = $_POST['role'];

    // Create an instance of the Database class and get the connection
    $database = new database();
    $db = $database->getConnection();

    // Create an instance of the User class
    $user = new user($db);

    // Call the update method
    if ($user->updateUser($matric, $name, $role)) {
        // Redirect to read.php on success
        header("Location: read.php");
        exit(); // Always include exit after header() to stop further execution
    } else {
        echo "Failed to update user!";
    }

    // Close the database connection
    $db->close();
} else {
    echo "Invalid request method!";
}
?>
