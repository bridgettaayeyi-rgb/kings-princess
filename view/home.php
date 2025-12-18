<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="designs/home.css">
  <title>The King's Princess</title>
</head>
<body>
<?php require __DIR__ . "/features/nav.php"; ?>
  <section class="hero">
    <div class="hero-content">
      <p class="scripture">"Blessed is she who has believed that the Lord would fulfill His promises to her." - Luke 1:45</p>
      <div class="buttons">
        <a href="index.php?page=devotions"  class="btn">Read Today's Devotion</a>
        <a href="index.php?page=prayerrequest" class="btn">Prayer Request</a>
      </div>
    </div>
  </section>
<!-- Welcome Heading -->
<section class="welcome-heading">
    <h2>Welcome to The King's Princess</h2>
  </section>
  
  <!-- Text + Image Layout -->
  <section class="welcome-section">
    <div class="welcome-text">
        <h3> Our Purpose</h3>
      <p>To guide women into a deeper relationship with God through devotions, prayer, 
        community support, and spiritual resources that strengthen their walk with Christ.</p>
      
      <h3> Our Inspiration</h3>
      <p>Don't just be inspired by the women of Scripture—be the next one. Esther didn't wait for 
        permission; Deborah demanded action; Ruth chose destiny. Their lives shatter the myth that 
        faith is quiet. We celebrate their legacy not to look back, but to propel ourselves forward, 
        challenging every woman to embrace their God-given boldness and wield their influence with 
        unwavering confidence today.</p>
      
      <h3> Why Join Us?</h3>
      <p>Because you deserve a safe, faith-filled community that builds you up. 
        Here, you will find motivation to grow spiritually, connect with other believers, 
        receive prayer support, and discover who God designed you to be.</p>
    </div>
    <div class="welcome-image">
      <img src="../designs/images/bible.jpg" alt="Reading Bible illustration">
    </div>
  </section>
<!--Snippets-->
  <section class="three-cards">
    <div class="card card-pink">
      <h3>Featured Books</h3>
      <p>These books provide wisdom, perspective, and practical advice from people 
        who have walked the path before you. They help you understand your faith and 
        your life better, equipping you with ideas and strength you might not have 
        discovered on your own.</p>
    </div>
  
    <div class="card card-purple">
      <h3>Devotional</h3>
      <p>It's a dedicated few minutes each day to step out of the noise, remember who 
        God is, and reset your heart and mind on what truly matters. It’s like checking
         your spiritual compass so you don't spend the whole day lost.</p>
    </div>
  
    <div class="card card-blue">
      <h3>Prayer Wall</h3>
      <p>It’s where you release everything you’ve been carrying, your anxiety, guilt, 
        plans, and gratitude into hands bigger than your own. It’s the intentional 
        pause to let go of what weighs you down and breathe in peace and perspective. 
        You don’t have to hold it all.</p>
    </div>
  </section>
<!--Statistics-->
<section class="stats-section">
  <div class="stat">
    <h3 class="counter" data-target="2.3" data-suffix="B" data-duration="1600">0</h3>
    <p>Christians Worldwide</p>
  </div>

  <div class="stat">
    <h3 class="counter" data-target="1.2" data-suffix="B" data-duration="1400">0</h3>
    <p>Christian Women</p>
  </div>

  <div class="stat">
    <h3 class="counter" data-target="500" data-suffix="M" data-duration="1200">0</h3>
    <p>Women Struggling Spiritually</p>
  </div>
</section>



<section class="value-prop">
  <p>
      At <strong>The King's Princess</strong>, we uplift, guide, and empower women of faith,
      especially those navigating spiritual dryness, identity battles, or emotional heaviness.
      You are seen, loved, and strengthened by God.
  </p>
</section>
<script src="designs/js/counting_home.js"></script>
<!-- Subscription Section -->
<section class="subscribe-section">
  <h2>Join Our Princess Fellowship</h2>
  <p>Receive weekly devotionals, faith inspiration, and community updates.</p>

  <form class="subscribe-form">
      <input type="email" placeholder="Enter your email" required>
      <button type="submit">Subscribe</button>
  </form>
</section>

<!-- Footer -->
<footer class="footer">
  <div class="footer-content">

      <!-- Logo -->
      <div class="footer-logo">
          <h3>The King's Princess</h3>
          <p>Shining for His Glory 🌸</p>
      </div>

      <!-- Contact Info -->
      <div class="footer-contact">
          <h4>Contact Us</h4>
          <p>Email: kingsprincess@gmail.com</p>
          <p>Phone: +233 55 123 4567</p>
          <p>Address: Accra, Ghana</p>
      </div>


  <p class="footer-copy">&copy; 2025 The King's Princess. All Rights Reserved.</p>
</footer>
</body>
</html>
