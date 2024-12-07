<?php
$servername = "localhost";
$username = "root";
$password = "2293";
$dbname = "sign_up";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Escape user inputs for security
$name = mysqli_real_escape_string($conn, $_POST['name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);

$password = mysqli_real_escape_string($conn, $_POST['password']);

// Prepare the SQL statement with placeholders
$sql = "INSERT INTO user_data (name, email, password) VALUES (?, ?, ?)";

// Prepare the statement
$stmt = $conn->prepare($sql);

// Bind the values to the placeholders
$stmt->bind_param("sss", $name, $email, $password);

// Execute the statement
$stmt->execute();

// Close the statement and the database connection
$stmt->close();
$conn->close();

// Redirect to login.html
header("Location: login.html");
exit;
?>
