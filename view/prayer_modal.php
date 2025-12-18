<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Prayer Request - The King's Princess</title>
<link rel="stylesheet" href="../designs/prayer.css">
</head>
<body>
<?php require __DIR__ . "/features/nav.php"; ?>
<section class="prayer-form-section">
    <h2>Share Your Prayer Request</h2>

    <?php if(!empty($response['message'] ?? '')): ?>
        <p class="<?= $response['status'] ?? 'error' ?>">
            <?= $response['message'] ?>
        </p>
    <?php endif; ?>

    <form id="prayerRequestForm" action="index.php?page=prayerrequest" method="POST" class="prayer-form">
    <input type="text" name="first_name" placeholder="First Name" required>
    <input type="text" name="last_name" placeholder="Last Name" required>
    <input type="email" id="prayerEmail" name="email" placeholder="Email (Optional)">
    <textarea name="message" placeholder="Your Prayer Request" required></textarea>
    <button type="submit" class="btn">Submit</button>
</form>
<p id="formMessage"></p>

</section>
<script>
const form = document.getElementById('prayerRequestForm');
const emailInput = document.getElementById('prayerEmail');
const formMessage = document.getElementById('formMessage');

form.addEventListener('submit', function(e) {
    const email = emailInput.value.trim();

    // If email is not empty, validate it
    if (email !== '') {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            e.preventDefault(); // Stop form submission
            formMessage.textContent = "Please enter a valid email address.";
            formMessage.style.color = 'red';
            return false;
        }
    }

    // If validation passes, clear message
    formMessage.textContent = '';
});
</script>

</body>
</html>
