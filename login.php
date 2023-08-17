<?php
// Database connection settings
$servername = "basicloginfunction.database.windows.net";
$username = "basiclogin";
$password = "fresh86#";
$dbname = "basicfunctiondb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user input
$username = $_POST['username'];
$password = $_POST['password'];

// SQL injection prevention (optional, consider using prepared statements)
$username = mysqli_real_escape_string($conn, $username);
$password = mysqli_real_escape_string($conn, $password);

// Query to check user credentials
$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = $conn->query($query);

if ($result->num_rows == 1) {
    // Successful login
    echo "Login successful!";
} else {
    // Failed login
    echo "Login failed. Please check your username and password.";
}

// Close the database connection
$conn->close();
?>
