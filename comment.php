<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "2293";
$dbname = "commentdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



$name = mysqli_real_escape_string($conn, $_POST['name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);

$comment = mysqli_real_escape_string($conn, $_POST['comment']);

// Prepare the SQL statement with placeholders
$sql = "INSERT INTO user_comment (name, email, comment) VALUES (?, ?, ?)";

// Prepare the statement
$stmt = $conn->prepare($sql);

// Bind the values to the placeholders
$stmt->bind_param("sss", $name, $email, $comment);

// Execute the statement
$stmt->execute();

// Close the statement and the database connection
$stmt->close();


// Retrieve data from the database
$sql = "SELECT * FROM user_comment";
$result = $conn->query($sql);


// Check if data exists
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        // Output HTML with CSS classes
        echo '<div class="review-container">';
        echo '<p class="review"><strong>Name:</strong> ' . $row['name'] . "</p>";
        echo "<p><strong>Email:</strong> " . $row['email'] . "</p>";
        echo "<p><strong>Review:</strong> " . nl2br($row['comment']) . "</p>";
        echo "<hr>";
        echo '</div>';
    }
} else {
    echo "No data found.";
}

// Close the database connection
$conn->close();



// *********************************************************
// Output styling CSS
echo '<style>
    .review-container {
  max-width: 600px;
  margin: 0 auto;
  padding: 20px;
}

.review {
  background-color: #f9f9f9;
  border: 1px solid #ddd;
  border-radius: 5px;
  padding: 10px;
  margin-bottom: 20px;
}

.review p {
  margin: 0;
}

.review h3 {
  font-size: 20px;
  margin-bottom: 10px;
}

.review .details {
  color: #888;
  font-size: 14px;
}

.review .message {
  margin-top: 10px;
}

.review .message p {
  line-height: 1.5;
}
</style>';




// *********************************************************
// Function Button
function get_buttons()
{
  $str='';
  $btns=array(
    1=>'Return to main page',
  );
  foreach ($btns as $k => $v) {
    $str.='<input type="submit" value="'.$v.'" name="btn_'.$k.'" id="btn_'.$k.'">';
  }
  return $str;
}
?>



 <!-- ********************************************************* -->
<!-- Button CSS -->
<html>
<head>
  <style>
    .button-container {
      display: flex;
      justify-content: center;
      margin-top: 20px;
    }

    .button-container input[type="submit"] 
    {
      background-color: #4CAF50;
      color: white;
      padding: 10px 20px;
      border: none;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      transition-duration: 0.4s;
      cursor: pointer;
    }

    .button-container input[type="submit"]:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
  <div class="button-container">
    <form method="get" action="index.html">
      <input type="submit" value="Return">
    </form>
  </div>
</body>
</html>
