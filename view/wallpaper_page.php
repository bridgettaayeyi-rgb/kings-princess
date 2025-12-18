<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Wallpapers - The King's Princess</title>
    <link rel="stylesheet" href="designs/wallpapers.css">
</head>
<body>
<?php require __DIR__ . '/features/nav.php'; ?>

<h2>Inspirational Wallpapers</h2>
<p class="intro">Download beautiful, faith-inspired wallpapers for your devices.</p>

<div class="wallpaper-grid">
    <?php if (!empty($wallpapers)): ?>
        <?php foreach ($wallpapers as $wp): ?>
            <div class="wallpaper-card">s
                <img src="<?= htmlspecialchars($wp['image_url']) ?>" alt="<?= htmlspecialchars($wp['title']) ?>">
                <div class="wallpaper-info">
                    <h4><?= htmlspecialchars($wp['title']) ?></h4>
                    <a href="<?= htmlspecialchars($wp['image_url']) ?>" download class="btn-download">
                        Download
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No wallpapers available yet.</p>
    <?php endif; ?>
</div>

</body>
</html>
