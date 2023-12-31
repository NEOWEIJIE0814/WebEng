<?php
// Include the database connection file
global $conn;
include 'dbconnect.php';

// Retrieve form data
$matricNo = $_POST['matricNo']; // Change the variable name here
$password = $_POST['password'];

// Query the database
$sql = "SELECT matricNo, passwordHash FROM users WHERE matricNo = '$matricNo'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $dbMatricNo = $row['matricNo'];
  $hashed_password = $row['passwordHash'];

  // Verify password
  if (password_verify($password, $hashed_password)) {
    // Password is correct
    // Check if matricNo is equal to 1
    if ($dbMatricNo == 1) {
      // Redirect to admin.html
      header("Location: ../admin.html");

    } else {
      // Redirect to index.html (or any other page for non-admin users)
      header("Location: ../index.html");

    }
  } else {
    // Password is incorrect
    echo "Invalid password.";
  }
} else {
  // User not found
  echo "Invalid matriculation number."; // Change the error message here
}

// Close database connection (you can omit this if you want to reuse the connection in other parts of your script)
$conn->close();
?>
