<?php
// Function to establish a database connection
function get_db_connection() {
    // Database connection parameters
    $servername = "sql210.infinityfree.com"; // Replace with your database server name
    $username_db = "if0_34581017"; // Replace with your database username
    $password_db = "xAGlVU29Ec"; // Replace with your database password
    $dbname = "if0_34581017_jalabiya"; // Replace with your database name

    // Create a new database connection
    $conn = new mysqli($servername, $username_db, $password_db, $dbname);

    // Check if the connection is successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}
?>
