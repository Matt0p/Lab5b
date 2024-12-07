<?php

session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

include 'database.php';
include 'user.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Retrieve the matric value from the GET request
    $matric = $_GET['matric'];

    // Create an instance of the Database class and get the connection
    $database = new database();
    $db = $database->getConnection();

    // Create an instance of the User class
    $user = new user($db);

    // Attempt to delete the user
    if ($user->deleteUser($matric)) {
        // If deletion is successful, redirect to read.php
        header("Location: read.php");
        exit; // Ensure no further code is executed
    } else {
        echo "Failed to delete user. Please try again.";
    }

    // Close the connection
    $db->close();
}
?>
