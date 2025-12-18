<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Today's Devotion - The King's Princess</title>
    <link rel="stylesheet" href="designs/devotions.css">
</head>
<body>
<?php require __DIR__ . "/features/nav.php"; ?>
<!-- Devotion Section -->
<section class="devotion-section">
    <h3><?php echo $devotion['title'] ?? "Today's Devotion"; ?></h3>
    
    <p class="scripture">
    <h4>Scripture:</h4>
        <?php echo $devotion['scripture'] ?? ""; ?>
    </p>

    <div class="message">
    <h4>Message:</h4>
        <p><?php echo $devotion['message'] ?? ""; ?></p>
    </div>

    <div class="application">
        <h4>Application:</h4>
        <p><?php echo $devotion['application'] ?? ""; ?></p>
    </div>

    <div class="prayer">
        <h4>Closing Prayer:</h4>
        <p><?php echo $devotion['prayer'] ?? ""; ?></p>
    </div>

    <div class="devotion-buttons">
        <a href="index.php?page=30daychallenge" class="btn">30 Day Challenge</a>
        <a href="index.php?page=prayerrequest" class="btn">Prayer Request</a>
        <a href="index.php?page=previousdevotions" class="btn">Previous Devotions</a>
        <a href="index.php?page=home" class="btn">Back to Home</a>
    </div>
</section>
</body>
</html>
