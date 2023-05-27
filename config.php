<?php
// Database configuration
     $username = $_POST['username'];
     $password = $_POST['password'];
     $email = $_POST['email'];
    

// Create database connection
$con = new mysqli('localhost','root','','nftmarketplace');

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Login form submission
if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Retrieve user from the database
  $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
  $result = $conn->query($query);

  if ($result->num_rows > 0) {
    // User found, redirect to home.html
    header("Location: home.html");
    exit();
  } else {
    // Invalid credentials, display error message
    echo "Invalid username or password";
  }
}

// Signup form submission
if (isset($_POST['signup'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $email = $_POST['email'];

  // Check if the username already exists in the database
  $checkQuery = "SELECT * FROM users WHERE username = '$username'";
  $checkResult = $conn->query($checkQuery);

  if ($checkResult->num_rows > 0) {
    // Username already taken, display error message
    echo "Username already exists";
  } else {
    // Insert the new user into the database
    $insertQuery = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
    if ($conn->query($insertQuery) === TRUE) {
      // User registered successfully, redirect to home.html
      header("Location: home.html");
      exit();
    } else {
      // Error occurred, display error message
      echo "Error: " . $insertQuery . "<br>" . $conn->error;
    }
  }
}

// Close the database connection
$conn->close();
?>
