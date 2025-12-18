<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Testimonies</title>
<link rel="stylesheet" href="../designs/testimony.css">
</head>

<body>
<?php require __DIR__ . "/features/nav.php"; ?>

<h2>Share Your Testimony</h2>
<div class="section-divider"></div>

<!-- Testimony Form -->
<div class="testimony-form-container">
    <form action="index.php?page=savetestimony" method="POST">

        <textarea name="testimony" rows="5" placeholder="Your testimony..." required></textarea>

        <button type="submit">Submit Testimony</button>
    </form>
</div>


<!-- Display All Testimonies -->
<h2>Testimonies</h2>
<div class="section-divider"></div>
<div class="testimony-list">
<?php if (!empty($testimonies)): ?>
    <?php foreach ($testimonies as $t): ?>
        <div class="testimony-card">
            <p><?= nl2br(htmlspecialchars($t['testimony'])) ?></p>
            <small>Posted on: <?= date("M d, Y", strtotime($t['created_at'])) ?></small>

            <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $t['user_id']): ?>
                <div class="actions">
                    <a href="index.php?page=editTestimony&testimonies_id=<?= $t['testimonies_id'] ?>" class="btn-edit">Edit</a>
                    <a href="index.php?page=deleteTestimony&testimonies_id=<?= $t['testimonies_id'] ?>"
                       class="btn-delete"
                       onclick="return confirm('Are you sure you want to delete this testimony?');">
                        Delete
                    </a>
                </div>
            <?php endif; ?>

        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p style="text-align:center;">No testimonies yet. Be the first to share!</p>
<?php endif; ?>
</div>
</body>
</html>