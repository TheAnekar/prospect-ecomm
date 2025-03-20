<?php
$serverName = "localhost"; // Change if SQL Server is remote
$connectionOptions = array(
    "Database" => "your_database_name",
    "Uid" => "hellobruh",
    "PWD" => "sikebiatch"
);

// Establish connection
$conn = sqlsrv_connect($serverName, $connectionOptions);
if (!$conn) {
    die(print_r(sqlsrv_errors(), true));
}

// Get data from HTML form

$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Securely hash the password

// Insert into database
$sql = "INSERT INTO users (username, password) VALUES (?, ?)";
$params = array($username, $password);
$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt) {
    echo "User registered successfully!";
} else {
    echo "Error: " . print_r(sqlsrv_errors(), true);
}

sqlsrv_close($conn);
?>
