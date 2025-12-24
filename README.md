Kings & Princess Christian Platform
A faith-based web application for daily devotionals, prayer community, and spiritual growth.
Key Features
  Daily & archived devotional content – Scripture, message, application, and prayer
  Prayer chain – Weekly coordinated spiritual activities and community prayer requests
  Testimony sharing – Secure submission and community encouragement
  Faith resources – Curated audio/video sermons, books, articles by topic
  30-day spiritual challenge – Progress tracking with completion metrics
  Admin dashboard – Full content management and user moderation
  Secure authentication – Role-based access with "Remember Me" functionality
Website: http://169.239.251.102:341/~bridgetta.akoto/kings-princess/
Video Demo: https://www.youtube.com/watch?v=RDxgB1721dA&feature=youtu.be
Code Structure:
kings-princess/
├── controller/         # All controllers (MVC)
├── models/             # Database models & business logic
├── view/               # Frontend templates & pages
├── config/             # Database configuration        
├── designs/             # CSS, JavaScript, fonts
├── index.php           # Single entry point & router
└── README.md           # This file

members (id, username, email, password, role, remember_token)
devotions (id, title, scripture, message, application, prayer, devotion_date)
testimonies (id, testimony, user_id, created_at)
prayer_chains (id, week_start, prayer_of_the_week, activity_type)
challenge_progress (id, user_id, day_number, is_read, read_at)
resources (id, title, type, topic, link, platform)
