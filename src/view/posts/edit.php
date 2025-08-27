<?php include __DIR__.'/../layouts/header.php'; ?>

<!-- <title><?= htmlspecialchars($user['username']) ?>'s Profile</title> -->

<div class="row">
    <!-- Left Column: Profile Info -->
    <?php include __DIR__.'/../layouts/profile-sidebar.php'; ?>

    <!-- Right Column: Post Form & Posts -->
    <div class="col-md-9">
        <!-- Edit Post Form -->
        <h3>Edit Post</h3>
        <form method="POST" action="index.php?action=update&user_id=<?= $user['id'] ?>&post_id=<?= $post['id'] ?>" class="mb-4">
            <input type="hidden" name="user_id" value="<?= $post['user_id'] ?>">
            <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
            <textarea name="content" class="form-control mb-2" required><?= htmlspecialchars($post['content']) ?></textarea>
            <button type="submit" value="Submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

 <?php include __DIR__.'/../layouts/footer.php'; ?>