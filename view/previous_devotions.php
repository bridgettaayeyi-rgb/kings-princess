<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Previous Devotions - The King's Princess</title>
<link rel="stylesheet" href="../designs/previous_devotions.css">
</head>
<body>
<?php include __DIR__ . "/features/nav.php"; ?>

<h2>Previous Devotions</h2>

<div class="prev-devotions-container">
    <?php 
    $colors = ['#f06292','#ba68c8','#64b5f6','#4db6ac','#ffb74d','#e57373'];
    $i = 0;
    foreach($devotions as $devotion): 
        $color = $colors[$i % count($colors)];
    ?>
        <div class="devotion-card" style="background: <?= $color ?>;">
            <h3><?= htmlspecialchars($devotion['title']) ?></h3>
            <p><?= date('F j, Y', strtotime($devotion['devotion_date'])) ?></p>
            <form action="" method="GET">
                <input type="hidden" name="page" value="showDevotion">
                <input type="hidden" name="id" value="<?= $devotion['devotions_id'] ?>">
                <button type="submit">Read Devotion</button>
            </form>
        </div>
    <?php 
        $i++;
    endforeach; 
    ?>
</div>

<a href="index.php?page=home" class="back-home">Back to Home</a>

</body>
</html>
