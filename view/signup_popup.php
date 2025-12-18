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
  <div class="overlay" id="signupPopup">
    <div class="popup">
      <span class="close-btn" id="closePopup">&times;</span>
      <form id="signupForm" action="index.php?page=signup" method="POST">
        <h3>Sign Up</h3>

        <?php if (!empty($response['message'])): ?>
            <p class="<?= $response['status'] ?>"><?= $response['message'] ?></p>
        <?php endif; ?>

        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required>
        <div id="nameError" class="error"></div>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required>
        <div id="nameError" class="error"></div>

        <label for="username">User Name:</label>
        <input type="text" id="username" name="username" required>
        <div id="nameError" class="error"></div>
    
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <div id="emailError" class="error"></div>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <div id="passwordError" class="error"></div>

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
        <div id="confirmError" class="error"></div>

        <input type="hidden" name="role" value="user">
        <input type="submit" id="signup-btn2" value="SIGN UP">
      </form>
    </div>
  </div>
 <!-- Include SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  // Show sign-up popup automatically
  window.onload = () => {
    setTimeout(() => {
      document.getElementById("signupPopup").style.display = "flex";
    }, 3000);
  };

  // Close button
  document.getElementById("closePopup").onclick = function() {
    document.getElementById("signupPopup").style.display = "none";
  };

  // Form validation
  const form = document.getElementById('signupForm');
  const emailInput = document.getElementById('email');
  const passwordInput = document.getElementById('password');
  const confirmInput = document.getElementById('confirm_password');

  form.addEventListener('submit', function(e) {
    e.preventDefault(); // stop default submission
    let valid = true;

    // Email validation
    const email = emailInput.value.trim();
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
      Swal.fire({
        icon: 'error',
        title: 'Invalid Email',
        text: 'Please enter a valid email address.'
      });
      emailInput.focus();
      valid = false;
      return;
    }

    // Password validation
    const password = passwordInput.value;
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/;
    if (!passwordRegex.test(password)) {
      Swal.fire({
        icon: 'error',
        title: 'Weak Password',
        text: 'Password must be at least 6 characters, contain uppercase, lowercase, number, and special character.'
      });
      passwordInput.focus();
      valid = false;
      return;
    }

    // Confirm password check
    if (password !== confirmInput.value) {
      Swal.fire({
        icon: 'error',
        title: 'Password Mismatch',
        text: 'Passwords do not match.'
      });
      confirmInput.focus();
      valid = false;
      return;
    }

    // If all validations pass, submit the form
    if (valid) {
      form.submit();
    }
  });
</script>

</body>
</html>
