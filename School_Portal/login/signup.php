<?php
  include('NavBarLogin.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Sign Up</title>
   
   <link rel="stylesheet" type="text/css" href="style_signup.css">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
 
</head>
<body>

<form class="login-form" action="signup_save.php" method="post">
  <div class="input-floating-label">
    <i class="fas fa-user icon"></i> <!-- User Icon -->
    <input class="input" type="text" id="username" name="username" placeholder="username" required>
    <label for="username">Username</label>
    <span class="focus-bg"></span>
  </div>

  <div class="input-floating-label">
    <i class="fas fa-lock icon"></i> <!-- Password Icon -->
    <input class="input" type="password" id="password" name="password" placeholder="password" required>
    <label for="password">Password</label>
    <span class="focus-bg"></span>
  </div>
  
  <div class="input-floating-label">
    <i class="fas fa-lock icon"></i> <!-- Password Icon -->
    <input class="input" type="password" id="confirm_password" name="confirm_password" placeholder="password" required>
	 
    <label for="password">Confirm Password</label>
    <span class="focus-bg"></span>
  </div>

  <button id="submit" class="btn-submit">Sign up</button>
</form>

</body>
</html>
<!--
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="login-container">
    <div class="login-box">
        <h2>Sign Up</h2>
        <form action="signup_save.php" method="post">
           <select name="usertype" class="dd">
		   <option value="Admin">Admin</option>
		   <option value="Supervisor">Supervisor</option>
		   <option value="User">User</option>
		   </select>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <button type="submit">Sign Up</button>
        </form>
    </div>
</div>

</body>
</html>
-->