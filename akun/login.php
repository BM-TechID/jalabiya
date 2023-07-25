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
    $password = $_POST["password"];

    // Get database connection
    $conn = get_db_connection();

    // Prepare the SQL statement with a prepared statement
    $sql = "SELECT  username, password FROM register WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username); // Bind the parameter, "s" stands for string

    // Execute the prepared statement
    $stmt->execute();

    // Store the result set
    $result = $stmt->get_result();

    // Check if the username exists in the database
    if ($result->num_rows == 1) {
        // If the username exists, retrieve the user data
        $row = $result->fetch_assoc();
        $stored_password = $row["password"];

        // Verify the password against the stored hash
        if (password_verify($password, $stored_password)) {
            // Login successful! Redirect the user to home.html after successful login
            header("Location: ../akun.html");
            exit;
        } else {
            echo "Invalid password";
        }
    } else {
        echo "Invalid username";
    }

    // Close the prepared statement
    $stmt->close();

    // Close the database connection
    $conn->close();
}
?>
