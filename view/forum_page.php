<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="designs/forum.css">
</head>
<body>
<?php require __DIR__ . '/features/nav.php'; ?>

<h1>Faith Forum</h1>
<p>Ask questions, share insights, and build faith together.</p>

<!-- CREATE POST -->
<form method="POST" class="post-form">
    <input type="text" name="title" placeholder="Post title" required>
    <textarea name="content" placeholder="Share your question or insight..." required></textarea>
    <button type="submit" name="post">Post</button>
</form>

<!-- DISPLAY POSTS -->
<?php foreach ($posts as $post): ?>
    <div class="forum-post">

        <h3><?= htmlspecialchars($post['title']) ?></h3>
        <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
        <small>
            Posted by <?= htmlspecialchars($post['name']) ?> |
            <?= date("M d, Y", strtotime($post['created_at'])) ?>
        </small>

        <!-- REPLIES -->
        <div class="replies">
            <?php if (!empty($post['replies'])): ?>
                <?php foreach ($post['replies'] as $reply): ?>
                    <div class="reply">
                        <p><?= nl2br(htmlspecialchars($reply['content'])) ?></p>
                        <small>
                            <?= htmlspecialchars($reply['name']) ?> |
                            <?= date("M d, Y", strtotime($reply['created_at'])) ?>
                        </small>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="no-replies">No replies yet.</p>
            <?php endif; ?>
        </div>

        <!-- ADD REPLY -->
        <form method="POST" class="reply-form">
            <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
            <textarea name="content" placeholder="Write a reply..." required></textarea>
            <button type="submit" name="reply">Reply</button>
        </form>

    </div>
<?php endforeach; ?>
</body>
</html>
