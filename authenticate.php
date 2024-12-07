<?php
session_start();
include 'database.php';
include 'user.php';

if (isset($_POST['submit']) && ($_SERVER['REQUEST_METHOD'] == 'POST')) {
    // Create database connection
    $database = new database();
    $db = $database->getConnection();

    // Sanitize inputs
    $matric = $db->real_escape_string(trim($_POST['matric']));
    $password = $db->real_escape_string(trim($_POST['password']));

    // Validate inputs
    if (!empty($matric) && !empty($password)) {
        $user = new User($db);
        $userDetails = $user->getUser($matric);

        // Check if user exists and verify password
        if ($userDetails && password_verify($password, $userDetails['password'])) {
            $_SESSION['user'] = $userDetails['matric']; // Save user session
            header("Location: read.php");
            exit;
        } else {
            echo "Invalid username or password. Try <a href='login.php'>login</a> again.";
        }
    } else {
        echo 'Please fill in all required fields.';
    }
}
?>
