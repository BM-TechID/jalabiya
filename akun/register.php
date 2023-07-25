<?php
// Include the database connection file
include 'db_connection.php';

// Function to sanitize user inputs
function sanitize_input($input) {
    return htmlspecialchars(trim($input));
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and sanitize inputs
    $username = sanitize_input($_POST["username"]);
    $email = sanitize_input($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash the password for security

    // Get database connection
    $conn = get_db_connection();

    // Prepare the SQL statement to insert data into the database
    $sql = "INSERT INTO register (username, email, password) VALUES ('$username', '$email', '$password')";

    // Check if the data insertion is successful
    if ($conn->query($sql) === TRUE) {
        // Registration successful, display the success message
        echo "Registration successful!";

        // Redirect to the login page after a short delay (e.g., 2 seconds)
        header("refresh:2; url=index.html");
        exit;
    } else {
        // If there's an error with the database query, display the error message
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
