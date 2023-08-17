<?php
// Database connection settings
$serverName = "tcp:basicloginfunction.database.windows.net,1433";
$connectionOptions = array(
    "Database" => "basicfunctiondb",
    "Uid" => "basiclogin",
    "PWD" => "fresh86#"
);

// Establish a connection to SQL Server
$conn = sqlsrv_connect($serverName, $connectionOptions);

// Check the connection
if ($conn === false) {
    die("Connection failed: " . print_r(sqlsrv_errors(), true));
}

// Retrieve user input
$username = $_POST['username'];
$password = $_POST['password'];

// SQL injection prevention (optional, consider using prepared statements)
$username = sqlsrv_real_escape_string($conn, $username);
$password = sqlsrv_real_escape_string($conn, $password);

// Query to check user credentials
$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = sqlsrv_query($conn, $query);

if ($result === false) {
    die("Query execution failed: " . print_r(sqlsrv_errors(), true));
}

if (sqlsrv_has_rows($result)) {
    // Successful login
    echo "Login successful!";
} else {
    // Failed login
    echo "Login failed. Please check your username and password.";
}

// Close the database connection
sqlsrv_close($conn);
?>
