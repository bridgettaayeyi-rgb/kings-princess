<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Resources</title>
    <link rel="stylesheet" href="designs/resources.css">
</head>
<body>

<?php require __DIR__ . '/features/nav.php'; ?>

<h1 class="page-title">Faith Resources</h1>
<p class="page-intro">
    Curated resources to strengthen your faith and daily walk.
</p>

<!-- Tabs -->
<div class="tabs">
    <button class="tab-btn active" onclick="openTab(event,'audio')">Audio Sermons</button>
    <button class="tab-btn" onclick="openTab(event,'video')">Video Sermons</button>
    <button class="tab-btn" onclick="openTab(event,'reading')">Books & Articles</button>
    <button class="tab-btn" onclick="openTab(event,'forum')">Forum</button>
    <button class="tab-btn" onclick="openTab(event,'wallpapers')">Wallpapers</button>
</div>

<!-- ================= AUDIO ================= -->
<div id="audio" class="tab-content active">
    <h2>Audio Sermons</h2>
    <p class="section-desc">
        Spirit-filled audio teachings on leadership, relationships, finance, and faith.
    </p>

    <?php if (!empty($audios)): ?>
        <?php foreach ($audios as $audio): ?>
            <div class="resource-item">
                <h4><?= htmlspecialchars($audio['title']) ?></h4>
                <p class="meta">
                    Topic: <?= htmlspecialchars($audio['topic']) ?> |
                    Platform: <?= htmlspecialchars($audio['platform']) ?>
                </p>
                <a href="<?= htmlspecialchars($audio['link']) ?>" target="_blank">
                    Listen
                </a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No audio sermons available.</p>
    <?php endif; ?>
</div>

<!-- ================= VIDEO ================= -->
<div id="video" class="tab-content">
    <h2>Video Sermons</h2>
    <p class="section-desc">
        Watch sermons and teachings to grow deeper in the Word.
    </p>

    <?php if (!empty($videos)): ?>
        <?php foreach ($videos as $video): ?>
            <div class="resource-item">
                <h4><?= htmlspecialchars($video['title']) ?></h4>
                <p class="meta">
                    Topic: <?= htmlspecialchars($video['topic']) ?> |
                    Platform: <?= htmlspecialchars($video['platform']) ?>
                </p>
                <a href="<?= htmlspecialchars($video['link']) ?>" target="_blank">
                    Watch
                </a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No video sermons available.</p>
    <?php endif; ?>
</div>

<!-- ================= BOOKS & ARTICLES ================= -->
<div id="reading" class="tab-content">
    <h2>Books & Articles</h2>
    <p class="section-desc">
        Recommended books and articles for spiritual growth.
    </p>

    <?php if (!empty($readings)): ?>
        <?php foreach ($readings as $item): ?>
            <div class="resource-item">
                <h4><?= htmlspecialchars($item['title']) ?></h4>
                <p class="meta">
                    Topic: <?= htmlspecialchars($item['topic']) ?> |
                    Type: <?= ucfirst($item['type']) ?>
                </p>
                <a href="<?= htmlspecialchars($item['link']) ?>" target="_blank">
                    Read
                </a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No books or articles available.</p>
    <?php endif; ?>
</div>

<!-- ================= FORUM ================= -->
<div id="forum" class="tab-content">
    <h2>Faith Forum</h2>
    <p class="section-desc">
        Ask questions, share insights, and grow together in faith.
    </p>

    <a href="index.php?page=forum" class="primary-btn">
        Go to Forum
    </a>
</div>

<!-- ================= WALLPAPERS ================= -->
<div id="wallpapers" class="tab-content">
    <h2>Wallpapers</h2>
    <p class="section-desc">
        Download inspirational wallpapers for your devices.
    </p>

    <a href="index.php?page=wallpapers" class="primary-btn">
        View Wallpapers
    </a>
</div>

<script>
function openTab(evt, tabId) {
    document.querySelectorAll('.tab-content').forEach(tab => {
        tab.classList.remove('active');
    });

    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('active');
    });

    document.getElementById(tabId).classList.add('active');
    evt.currentTarget.classList.add('active');
}
</script>

</body>
</html>
