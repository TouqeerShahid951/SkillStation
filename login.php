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
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

// Prepare the SQL statement with placeholders
$sql = "SELECT * FROM user_data WHERE email = ? AND password = ?";

// Prepare the statement
$stmt = $conn->prepare($sql);

// Bind the values to the placeholders
$stmt->bind_param("ss", $email, $password);

// Execute the statement
$stmt->execute();

// Fetch the result
$result = $stmt->get_result();

// Check if the user credentials are valid
if ($result->num_rows === 1) {
    // Valid credentials
    header("Location: index.html");
    exit();
} else {
    // Invalid credentials
    echo '<script>alert("Email or password is incorrect."); window.location = "login.html";</script>';
}

// Close the statement and the database connection
$stmt->close();
$conn->close();

exit;
?>

