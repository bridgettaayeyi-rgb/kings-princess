<?php
//var_dump($devotions);
//exit;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard</title>
<link rel="stylesheet" href="../designs/admin.css">
<style>
    nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 50px;
    background: rgba(255, 255, 255, 0.3); /* glass effect */
    backdrop-filter: blur(10px);
    border-radius: 15px;
    margin: 20px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    z-index: 9999;
  }

  nav .logo {
    font-family: 'Playfair Display', serif;
    font-size: 24px;
    font-weight: bold;
    color: #880e4f; /* rich pink */
  }

  nav ul {
    display: flex;
    list-style: none;
    gap: 30px;
  }

  nav ul li {
    position: relative;
  }

  nav ul li a {
    text-decoration: none;
    color: #880e4f;
    font-weight: 500;
    padding: 8px 12px;
    border-radius: 8px;
    transition: 0.3s;
  }

  /* Hover Effects */
  nav ul li a:hover {
    background: rgba(255, 255, 255, 0.6);
    color: #ad1457;
  }
</style>
</head>
<body>

<nav>
    <div class="logo">The King's Princess</div>
    <ul>
        <li><a href="index.php?page=profile">Profile</a></li>
    </ul>
</nav>

<h1>Admin Dashboard</h1>

<div class="tabs">
    <button class="tab-btn active" onclick="openTab(event,'devotions')">Devotions</button>
    <button class="tab-btn" onclick="openTab(event,'resources')">Resources</button>
    <button class="tab-btn" onclick="openTab(event,'prayer')">Prayer Chain</button>
    <button class="tab-btn" onclick="openTab(event,'wallpapers')">Wallpapers</button>
</div>

<!-- Devotions -->
<div id="devotions" class="tab-content active">
    <h2>Add Devotion</h2>
    <form method="POST" action="index.php?page=createDevotion">
        <input type="text" name="title" placeholder="Title" required>
        <input type="text" name="scripture" placeholder="Scripture" required>
        <textarea name="message" placeholder="Message" required></textarea>
        <textarea name="application" placeholder="Application" required></textarea>
        <textarea name="prayer" placeholder="Closing Prayer" required></textarea>
        <input type="date" name="devotion_date" required>
        <button type="submit">Add Devotion</button>
    </form>
    <h2>Existing Devotions</h2>

<div class="admin-cards">
<?php foreach ($devotions as $devotion): ?>
    <div class="admin-card">
        <h3><?php echo htmlspecialchars($devotion['title']); ?></h3>

        <a href="index.php?page=editDevotion&id=<?php echo $devotion['devotions_id']; ?>" class="edit-btn">
            Edit
        </a>

        <a href="index.php?page=deleteDevotion&id=<?php echo $devotion['devotions_id']; ?>"
           class="delete-btn"
           onclick="return confirm('Delete this devotion?')">
           Delete
        </a>
    </div>
<?php endforeach; ?>

</div>
</div>

<!-- Resources -->
<div id="resources" class="tab-content">
    <h2>Add Resource</h2>
    <form method="POST" action="index.php?page=createResource">
        <input type="text" name="title" placeholder="Title" required>
        <textarea name="description" placeholder="Description"></textarea>
        <select name="type" required>
            <option value="audio">Audio</option>
            <option value="video">Video</option>
            <option value="book">Book</option>
            <option value="article">Article</option>
        </select>
        <input type="text" name="topic" placeholder="Topic">
        <input type="text" name="platform" placeholder="Platform (YouTube, Spotify)">
        <input type="text" name="link" placeholder="Link" required>
        <input type="text" name="thumbnail" placeholder="Thumbnail URL (optional)">
        <button type="submit">Add Resource</button>
    </form>

    <h2>Existing Resources</h2>

    <div class="admin-cards">
<?php foreach ($resources as $resource): ?>
    <div class="admin-card">
        <h3><?php echo htmlspecialchars($resource['title']); ?></h3>

        <a href="index.php?page=editResource&id=<?php echo $resource['id']; ?>" class="edit-btn">
            Edit
        </a>

        <a href="index.php?page=deleteResource&id=<?php echo $resource['id']; ?>"
           class="delete-btn"
           onclick="return confirm('Delete this devotion?')">
           Delete
        </a>
    </div>
<?php endforeach; ?>

</div>
</div>

<!-- Prayer Chain -->
<div id="prayer" class="tab-content">
    <h2>Set Prayer of the Week & Activity</h2>
    <form method="POST" action="index.php?page=setPrayerChain">
        <input type="date" name="week_start" required>
        <textarea name="prayer_of_the_week" placeholder="Prayer of the Week" required></textarea>
        <select name="activity_type" required>
            <option value="Prayer">Prayer</option>
            <option value="Fasting">Fasting</option>
            <option value="Evangelism">Evangelism</option>
            <option value="Reflection">Reflection</option>
        </select>
        <textarea name="activity_description" placeholder="Activity Description"></textarea>
        <button type="submit">Save</button>
    </form>
</div>

<!-- Wallpapers -->
<div id="wallpapers" class="tab-content">
    <h2>Add Wallpaper</h2>
    <form method="POST"
      action="index.php?page=addWallpaper"
      enctype="multipart/form-data">

    <input type="text" name="title" placeholder="Title" required>

    <input type="file"
           name="image"
           accept="image/*"
           required>

    <button type="submit">Add Wallpaper</button>
</form>

    <h2>Existing Wallpapers</h2>
    <div class="admin-cards">
<?php foreach ($wallpapers as $wallpaper): ?>
    <div class="admin-card">
        <div>
            <h3><?= htmlspecialchars($wallpaper['title']) ?></h3>
            <img 
                src="<?= htmlspecialchars($wallpaper['image_url']) ?>" 
                style="width:100%; border-radius:12px; margin-top:10px;"
            >
        </div>

        <div class="admin-card">
            <a href="index.php?page=deleteWallpaper&id=<?= $wallpaper['id'] ?>"
               class="delete-btn"
               onclick="return confirm('Delete this wallpaper?')">
               Delete
            </a>
        </div>
    </div>
<?php endforeach; ?>
</div>

</div>

<script>
function openTab(evt, tabId) {
    document.querySelectorAll('.tab-content').forEach(tab => tab.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
    document.getElementById(tabId).classList.add('active');
    evt.currentTarget.classList.add('active');
}
</script>

</body>
</html>
