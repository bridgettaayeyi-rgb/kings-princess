<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="../designs/login_signup.css">
</head>
<body>

<div id="loginPopup" class="overlay">
    <div class="popup">
        <h3>Welcome back, Princess</h3>
        <p>Logging you in...</p>
    </div>
</div>

<script>
// Play fade-out animation
setTimeout(() => {
    document.getElementById("loginPopup").classList.add("fade-out");
}, 3000);

// Redirect AFTER fade
setTimeout(() => {
    window.location.href = "index.php?page=home";
}, 1300);
</script>

</body>
</html>
