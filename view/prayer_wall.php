
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Prayer Wall</title>
<link rel="stylesheet" href="../designs/prayer_wall.css">
</head>
<body>
<?php require __DIR__ . "/features/nav.php"; ?>
<section class="hero">
    <div class="hero-content">
      <p class="scripture">"And he spake a parable unto them to this end, that men 
        ought always to pray, and not to faint;" - Luke 18:1</p>
    </div>
  </section>

<h2>Prayer Wall</h2>

<!-- MAIN CARDS -->
<div class="prayer-wall-cards">

    <div class="card prayer-chain-card" onclick="scrollToChain()">
        Prayer Chain
        <p>A weekly spiritual guide that leads the community in 
            focused prayer, fasting, reflection, or evangelism. It unites 
            people under one shared spiritual purpose.</p>
    </div>

    <div class="card prayer-request-card" onclick="location.href='index.php?page=prayerrequest'">
        Prayer Request
        <p>A sacred space where you can share your burdens, needs, and concerns. 
            Your prayer will be received, kept confidential, and lifted before 
            God by the community.</p>
    </div>

    <div class="card testimonies-card" onclick="location.href='index.php?page=testimonies'">
        Testimonies
        <p>A collection of stories showing what God has done in the lives of people. 
            You can read others’ testimonies, share your own, and celebrate God’s 
            faithfulness.</p>
    </div>

</div>


<!-- PRAYER CHAIN SECTION (scroll target) -->
<section id="prayer-chain-section">

    <h2>Prayer Chain</h2>

    <!-- Prayer of the Week -->
    <div class="prayer-item">
        <h3>Prayer of the Week</h3>
        <p><?= $prayerChain['prayer_of_the_week'] ?? "No prayer added yet." ?></p>
    </div>

    <!-- Activity of the Week -->
    <div class="prayer-item">
        <h3>Activity of the Week (<?= $prayerChain['activity_type'] ?? "" ?>)</h3>
        <p><?= $prayerChain['activity_description'] ?? "No activity added yet." ?></p>
    </div>

    <!-- All Prayer Requests 
    <div class="prayer-item">-->
    <h3>Community Prayer Requests</h3>

    <?php if (!empty($allRequests)): ?>
        <?php foreach ($allRequests as $index => $req): ?>
        
            <div class="request-mini">
                <strong>Request <?= $index + 1 ?></strong><br>
                <small>By <?= htmlspecialchars($req['first_name']) ?></small>

                <!-- Full prayer text appears on hover -->
                <div class="request-full">
                    <strong><?= htmlspecialchars($req['first_name']) ?></strong>
                    <p><?= nl2br(htmlspecialchars($req['message'])) ?></p>
                    <small>Submitted: <?= $req['created_at'] ?></small>
                </div>
            </div>

        <?php endforeach; ?>
    <?php else: ?>
        <p>No prayer requests yet.</p>
    <?php endif; ?>

<!--</div>-->

</section>


<script>
function scrollToChain() {
    document.getElementById("prayer-chain-section").scrollIntoView({ behavior: 'smooth' });
}
</script>

</body>
</html>