<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Resource</title>
<link rel="stylesheet" href="designs/prayer.css">
</head>
<body>

<section class="prayer-form-section">
<h2>Edit Resource</h2>

<?php if (!empty($resource)): ?>
<form method="POST" action="index.php?page=updateResource" form id="prayerRequestForm" class="prayer-form">
    <input type="hidden" name="id" value="<?= htmlspecialchars($resource['id']) ?>">

    <label>Title:</label>
    <input type="text" name="title" value="<?= htmlspecialchars($resource['title']) ?>" required>

    <label>Description:</label>
    <textarea name="description"><?= htmlspecialchars($resource['description']) ?></textarea>

    <label>Type:</label>
    <select name="type" required>
        <option value="audio" <?= $resource['type'] === 'audio' ? 'selected' : '' ?>>Audio</option>
        <option value="video" <?= $resource['type'] === 'video' ? 'selected' : '' ?>>Video</option>
        <option value="book" <?= $resource['type'] === 'book' ? 'selected' : '' ?>>Book</option>
        <option value="article" <?= $resource['type'] === 'article' ? 'selected' : '' ?>>Article</option>
    </select><br>

    <label>Topic:</label>
    <input type="text" name="topic" value="<?= htmlspecialchars($resource['topic']) ?>">

    <label>Platform:</label>
    <input type="text" name="platform" value="<?= htmlspecialchars($resource['platform']) ?>">

    <label>Link:</label>
    <input type="text" name="link" value="<?= htmlspecialchars($resource['link']) ?>" required>

    <label>Thumbnail URL (optional):</label>
    <input type="text" name="thumbnail" value="<?= htmlspecialchars($resource['thumbnail']) ?>">

    <button type="submit">Update Resource</button>
    <a href="index.php?page=admin" >
        <button>Cancel</button></a>
</form>
<?php else: ?>
<p>Resource not found.</p>
<?php endif; ?>
</section>
</body>
</html>
