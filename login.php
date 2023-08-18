<?php
// Attempt to create a PDO connection (for error handling)
try {
    $pdo = new PDO("sqlsrv:server = tcp:basicloginfunction.database.windows.net,1433; Database = basicfunctiondb", "basiclogindb", "{fresh86#}");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error connecting to SQL Server: " . $e->getMessage());
}

// Define connection options for sqlsrv
$connectionOptions = array(
    "UID" => "basiclogindb",
    "PWD" => "{fresh86#}",
    "Database" => "basicfunctiondb",
    "LoginTimeout" => 30,
    "Encrypt" => 1,
    "TrustServerCertificate" => 0
);

$serverName = "tcp:basicloginfunction.database.windows.net,1433";

// Attempt to establish the sqlsrv connection (for error handling)
$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die("Connection failed: " . print_r(sqlsrv_errors(), true));
}

else {
    // Failed login
    echo "Connection success.";

}

// Retrieve user input
$username = $_POST['username'];
$password = $_POST['password'];


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




// Close the database connections
sqlsrv_close($conn);
$pdo = null; // Close the PDO connection as well
?>
