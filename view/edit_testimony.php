<!DOCTYPE html>
<html>
<head>
<title>Edit Testimony</title>
<link rel="stylesheet" href="designs/prayer.css">
</head>
<body>
<?php require __DIR__ . "/features/nav.php"; ?>

<section class="prayer-form-section">
    <h2>Edit Testimony</h2>

    <form action="index.php?page=updateTestimony" method="POST" class="prayer-form">
        <input type="hidden" name="testimonies_id" value="<?= $testimony['testimonies_id'] ?>">
        <textarea name="testimony" placeholder="Your Testimony" rows="5" required>
            <?= isset($testimony['testimony']) ? htmlspecialchars($testimony['testimony']) : '' ?>
        </textarea>

        <button type="submit" class="btn">Update Testimony</button>
    </form>
</section>
</body>
</html>
