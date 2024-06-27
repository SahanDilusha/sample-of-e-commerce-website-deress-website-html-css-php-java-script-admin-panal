<?php
// Include database connection or any necessary dependencies
include "connecton.php";

// Assuming you're receiving username and password via POST
$username = $_POST["username"];
$password = $_POST["password"];

// Basic validation
if ($username == "") {
    echo ("Please enter your username!");
} else if ($password == "") {
    echo ("Password is required!");
} else if (!preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,45}$/', $password)) {
    echo ("Invalid password!");
} else {
    // Perform user authentication query (adjust SQL query as per your database schema)
    $checkUser = Database::search("SELECT * FROM `system_login` WHERE `system_login_username` = '" . $username . "' AND `password` = '" . $password . "' AND `stetus_stetus_id` = '1';");

    // Check if user exists and credentials are valid
    if ($checkUser->num_rows == 0) {
        echo ("Invalid username or password!");
    } else {
        // If authentication is successful, proceed to generate and download database backup
        header("Location: http://localhost/myshop-admin/data-backup.php"); // Redirect to backup script
        exit;
    }
}
?>
