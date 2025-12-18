<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Profile</title>
    <link rel="stylesheet" href="../designs/profile.css">
</head>
<body>

<?php require __DIR__ . '/features/nav.php'; ?>

<div class="profile-container">

    <h2>My Profile</h2>

    <div class="profile-card">
        <p><strong>First Name:</strong> <?= htmlspecialchars($user['first_name']) ?></p>
        <p><strong>Last Name:</strong> <?= htmlspecialchars($user['last_name']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
        <p><strong>Member Since:</strong> <?= date("F j, Y", strtotime($user['created_at'])) ?></p>
    </div>

    <div class="profile-actions">
        <a href="index.php?page=logout" class="btn-logout">
            Log Out
        </a>
    </div>

</div>

</body>
</html>
