<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>30 Day Challenge - The King's Princess</title>
<link rel="stylesheet" href="../designs/challenge.css">
</head>
<body>

<?php include __DIR__ . "/features/nav.php"; ?>

<section class="challenge-header">
    <h2>✨ 30-Day Spiritual Growth Challenge ✨</h2>
    <p class="welcome-text">
        Welcome, Princess! This 30 day bible study journey is designed to strengthen your walk with God,
        deepen your understanding of His Word, and help you grow in grace, faith, and purpose.
    </p>
</section>

<section class="challenge-day">

    <div class="day-card">
        <h3>Day <?= $challenge['day_number'] ?? 1 ?></h3>
        <div class="chapter-title">
        <h4><?= htmlspecialchars($challenge['title']?? "God is merciful") ?></h4>
            <p><?= htmlspecialchars($challenge['chapter']?? "Psalm 1") ?></p>
        </h4>
        </div>

        <div class="reflection-box">
            <h4>💗 Reflection</h4>
            <p><?= nl2br(htmlspecialchars($challenge['reflection'] ?? "Allow God's Word to speak to your heart today.")) ?></p>
        </div>
    </div>

</section>

<label>
    <input type="checkbox" class="read-checkbox" <?= $progress ? 'checked' : '' ?> 
           onclick="window.location='index.php?page=markread&day=<?= $day ?>'">
    I have read today’s chapter
</label>

<div class="progress-container">
    <div class="progress-bar" style="width: <?= $percent ?>%;"></div>
</div>

<p class="progress-text">
    <?= round($percent) ?>% completed
</p>

<a href="index.php?page=home" class="back-home">Back to Home</a>

</body>
</html>
