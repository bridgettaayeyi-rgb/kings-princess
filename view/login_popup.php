<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="designs/login_signup.css">
  <title>Home Page</title>
</head>
<body>
  <!-- Overlay Pop-up -->
  <div class="overlay" id="loginPopup">
    <div class="popup">
      <span class="close-btn" id="closePopup">&times;</span>
      <form id="loginForm" action="index.php?page=login" method="POST">
        <h3>Welcome, Princess 👑</h3>
        <p>Log In</p>

        <?php if (!empty($error)): ?>
                <p style="color:red;"><?= $error ?></p>
            <?php endif; ?>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label class="remember-row">
          <input type="checkbox" name="remember_me">
          Remember Me 
        </label>

        <input type="submit" value="LOG IN">
        <p>Don't have an account? <a href="index.php?page=signup">Sign Up</a></p>
      </form>
    </div>
  </div>

  <script>
    // Show the pop-up after 5 seconds
    window.onload = function() {
      setTimeout(function() {
        document.getElementById("loginPopup").style.display = "flex";
      }, 5000); 
    };

    // Close button functionality
    document.getElementById("closePopup").onclick = function() {
      document.getElementById("loginPopup").style.display = "none";
    };
  </script>
</body>
</html>
