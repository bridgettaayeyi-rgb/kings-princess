-- Create database
CREATE DATABASE kings_princess;

-- Use the database
USE kings_princess;

CREATE TABLE members (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  first_name VARCHAR(100) NOT NULL,
  last_name VARCHAR(100) NOT NULL,
  username VARCHAR(100) NOT NULL UNIQUE,
  email VARCHAR(150) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('user','admin') NOT NULL DEFAULT 'user',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE devotions (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  scripture VARCHAR(255) NOT NULL,
  message TEXT NOT NULL,
  application TEXT NOT NULL,
  prayer TEXT NOT NULL,
  devotion_date DATE NOT NULL UNIQUE,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE challenge_days (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  day_number TINYINT NOT NULL UNIQUE,
  title VARCHAR(255) NOT NULL,
  chapter VARCHAR(255) NOT NULL,
  reflection TEXT NOT NULL
);

CREATE TABLE challenge_progress (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  day_number TINYINT NOT NULL,
  is_read BOOLEAN DEFAULT FALSE,
  read_at TIMESTAMP NULL,
  UNIQUE KEY user_day (user_id, day_number),
  FOREIGN KEY (user_id) REFERENCES members(id) ON DELETE CASCADE,
  FOREIGN KEY (day_number) REFERENCES challenge_days(day_number) ON DELETE CASCADE
);

CREATE TABLE prayer_requests (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  first_name VARCHAR(100) NOT NULL,
  last_name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NULL,
  message TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE prayer_chain (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  week_start DATE NOT NULL,
  prayer_of_the_week TEXT NOT NULL,
  activity_type ENUM('Prayer','Fasting','Evangelism','Reflection') NOT NULL,
  activity_description TEXT NULL
);

CREATE TABLE testimonies (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  user_name VARCHAR(100) NOT NULL,
  testimony TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES members(id) ON DELETE CASCADE
);

CREATE TABLE resources (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  description TEXT NULL,
  type ENUM('audio','video','book','article') NOT NULL,
  topic VARCHAR(100) NULL,
  platform VARCHAR(50) NULL,
  link TEXT NOT NULL,
  thumbnail VARCHAR(255) NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE forum_posts (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  title VARCHAR(255) NOT NULL,
  content TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES members(id) ON DELETE CASCADE
);

CREATE TABLE forum_replies (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  post_id INT NOT NULL,
  user_id INT NOT NULL,
  content TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (post_id) REFERENCES forum_posts(id) ON DELETE CASCADE,
  FOREIGN KEY (user_id) REFERENCES members(id) ON DELETE CASCADE
);

CREATE TABLE wallpapers (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  image_url VARCHAR(255) NOT NULL
);
