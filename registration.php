<?php
$servername = "localhost";
$username = "root";
$password = "2293";
$dbname = "registration";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Escape user inputs for security
$name = mysqli_real_escape_string($conn, $_POST['name']);
$father_name = mysqli_real_escape_string($conn, $_POST['father_name']);

$email = mysqli_real_escape_string($conn, $_POST['email']);
$data_of_birth = mysqli_real_escape_string($conn, date('Y-m-d', strtotime($_POST['date_of_birth'])));
$education = mysqli_real_escape_string($conn, $_POST['education']);
$bio = mysqli_real_escape_string($conn, $_POST['bio']);


$phonenumber = mysqli_real_escape_string($conn,intval( $_POST['phonenumber']));
$address = mysqli_real_escape_string($conn, $_POST['address']);

// Prepare the SQL statement with placeholders
$sql = "INSERT INTO user_registration (name,father_name,data_of_birth,education,bio, email, phonenumber,address) VALUES (?, ?, ?,?,?,?,?,?)";

// Prepare the statement
$stmt = $conn->prepare($sql);

// Bind the values to the placeholders
$stmt->bind_param("ssssssss", $name,$father_name,$data_of_birth,$education,$bio, $email, $phonenumber,$address);

// Execute the statement
$stmt->execute();

// Close the statement and the database connection
$stmt->close();
$conn->close();

// Redirect to index.html
header("Location: index.html");
exit;
?>
