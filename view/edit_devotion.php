<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Devotion</title>
<link rel="stylesheet" href="designs/prayer.css">
</head>
<body>


<section class="prayer-form-section">
<h2>Edit Devotion</h2>
<?php if (!empty($devotion)): ?>
<form method="POST" action="index.php?page=updateDevotion" form id="prayerRequestForm" class="prayer-form">
    <input type="hidden" name="id" value="<?= htmlspecialchars($devotion['devotions_id']) ?>">

    <label>Title:</label>
    <input type="text" name="title" value="<?= htmlspecialchars($devotion['title']) ?>" required>

    <label>Scripture:</label>
    <input type="text" name="scripture" value="<?= htmlspecialchars($devotion['scripture']) ?>" required>

    <label>Message:</label>
    <textarea name="message" required><?= htmlspecialchars($devotion['message']) ?></textarea>

    <label>Application:</label>
    <textarea name="application" required><?= htmlspecialchars($devotion['application']) ?></textarea>

    <label>Closing Prayer:</label>
    <textarea name="prayer" required><?= htmlspecialchars($devotion['prayer']) ?></textarea>

    <label>Devotion Date:</label>
    <input type="date" name="devotion_date" value="<?= htmlspecialchars($devotion['devotion_date']) ?>" required>

    <button type="submit">Update Devotion</button>
    <a href="index.php?page=admin">
        <button>Cancel</button></a>
</form>
<?php else: ?>
<p>Devotion not found.</p>
<?php endif; ?>
</section>
</body>
</html>
