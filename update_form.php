<?php
include 'database.php';
include 'user.php';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Retrieve the matric value from the GET request
    $matric = $_GET['matric'];

    // Create an instance of the Database class and get the connection
    $database = new database();
    $db = $database->getConnection();

    // Create an instance of the User class
    $user = new user($db);

    // Fetch user details
    $userDetails = $user->getUser($matric);

    // Check if user details were retrieved
    if ($userDetails) {
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Update User</title>
            <link rel="stylesheet" href="styles.css">
        </head>

        <body>
            <h1>Update User</h1>
            <form action="update.php" method="post">
                <label for="matric">Matric:</label>
                <input type="text" id="matric" name="matric" value="<?php echo $userDetails['matric']; ?>" readonly><br>
                
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $userDetails['name']; ?>" required><br>
                
                <label for="role">Access Level:</label>
                <select name="role" id="role" required>
                    <option value="">Please select</option>
                    <option value="lecturer" <?php if ($userDetails['role'] == 'lecturer') echo "selected"; ?>>Lecturer</option>
                    <option value="student" <?php if ($userDetails['role'] == 'student') echo "selected"; ?>>Student</option>
                </select><br>
                
                <div class="form-buttons">
                    <input type="submit" value="Update">
                    <button type="button" onclick="window.location.href='read.php'">Cancel</button>
                </div>
            </form>
        </body>

        </html>
        <?php
    } else {
        echo "User not found!";
    }

    // Close the database connection
    $db->close();
}
?>
