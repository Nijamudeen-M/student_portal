<?php
  // Start session
  session_start();
  
  // Include database connection
  include('../config.php');

  // Initialize error message variable
  $error_msg = '';

  // Check if the form has been submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Retrieve input data
      $username = $_POST['username'];
      $password = $_POST['password'];

      // SQL injection prevention
      $username = stripslashes($username);
      $password = stripslashes($password);
      $username = mysqli_real_escape_string($conn, $username);
      $password = mysqli_real_escape_string($conn, $password);

      // Query to fetch user from database
      $sql = "SELECT * FROM tbl_users WHERE username='$username'";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          // Fetch the row
          $row = $result->fetch_assoc();

          // Get the hashed password from the database
          $hashed_password_from_db = $row['password'];

          // Verify the password
          if (password_verify($password, $hashed_password_from_db)) {
              // Password is correct, start session and redirect
              $_SESSION['username'] = $username;
              header("location: ../students_list.php"); 
              exit(); // Important to stop further script execution
          } else {
              // Wrong password
              $error_msg = "Invalid username or password";
          }
      } else {
          // User not found
          $error_msg = "Invalid username or password";
      }

      // Close the connection
      $conn->close();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="style_index.css">
</head>
<body>

<form class="login-form" action="" method="post">
 <?php if ($error_msg): ?>
    <div class="error-message"><?php echo $error_msg; ?></div>
  <?php endif; ?>

  <div class="input-floating-label">
    <i class="fas fa-user icon"></i> <!-- User Icon -->
    <input class="input" type="text" id="username" name="username" placeholder="username" required>
    <label for="username">Username</label>
  </div>

  <div class="input-floating-label">
    <i class="fas fa-lock icon"></i> <!-- Password Icon -->
    <input class="input" type="password" id="password" name="password" placeholder="password" required>
    <i class="fas fa-eye" id="togglePassword"></i> <!-- Eye Icon for toggling password visibility -->
    <label for="password">Password</label>
  </div>

  <button id="submit" class="btn-submit">Login</button>
</form>

<script>
  const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#password');

  togglePassword.addEventListener('click', function () {
    // Toggle the type attribute between password and text
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);

    // Toggle the icon between eye and eye-slash
    this.classList.toggle('fa-eye-slash');
  });
</script>

</body>
</html>
