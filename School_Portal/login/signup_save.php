<?php
// Database connection
  include('../config.php');
  
// Retrieve input data

$username = $_POST['username'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirm_password'];
//die($usertype);
// Validate password match
if ($password !== $confirmPassword) {
    die("Error: Passwords do not match.");
}

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert user into database
$sql = "INSERT INTO tbl_users (username, password) VALUES ('$username', '$hashedPassword')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('New record created successfully!'); </script>";
   
	header("location: ../students_list.php"); 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
