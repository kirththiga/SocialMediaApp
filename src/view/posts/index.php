<?php include __DIR__ . '/../layouts/header.php';
include __DIR__ . '/../layouts/footer.php';
require_once __DIR__ . '/../../security/csrf.php'; ?>


    <div class="row">
        <!-- Left Column: Profile Info -->
        <?php include __DIR__ . '/../layouts/profile-sidebar.php'; ?>

        <!-- Right Column: Post Form & Posts -->
        <div class="col-md-9">
            <!-- Create Post Form -->
            <h3>Create a Post</h3>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>

            <form method="POST" action="index.php?action=create&user_id=<?= $user['id'] ?>" class="mb-4">
                <?= csrf_input('post_create') ?>
                <textarea name="content" class="form-control mb-2" rows="5" required></textarea>
                <button type="submit" value="Submit" class="btn btn-primary">Post</button>
            </form>

            <!-- Tabs for Posts / Feed -->
            <ul class="nav nav-tabs mb-3">
                <li class="nav-item">
                    <a class="nav-link active" href="#">My Posts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=feed">Feed</a>
                </li>
            </ul>

            <!-- Posts List -->
            <!-- <h3>Posts</h3> -->
            <?php if ($posts): ?>
                <?php foreach ($posts as $post): ?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
                            <small class="text-muted">
                                Posted on <?= date("F j, Y g:i A", strtotime($post['created_at'])) ?>
                                <?php if (!empty($post['updated_at'])): ?>
                                    <br><em>(Edited on <?= date("F j, Y g:i A", strtotime($post['updated_at'])) ?>)</em>
                                <?php endif; ?>
                            </small>
                            <br>
                            <a href="index.php?action=edit&user_id=<?= $user['id'] ?>&post_id=<?= $post['id'] ?>"
                               class="btn btn-sm btn-warning mt-2">Edit</a>
                            <form method="POST"
                                  action="index.php?controller=profile&action=delete"
                                  style="display:inline;">
                                <?= csrf_input('post_delete_' . (int)$post['id']) ?>
                                <input type="hidden" name="post_id" value="<?= (int)$post['id'] ?>">
                                <button type="submit" class="btn btn-sm btn-danger mt-2"
                                        onclick="return confirm('Are you sure you want to delete this post?');">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No posts yet.</p>
            <?php endif; ?>
        </div>
    </div>
<?php include __DIR__ . '/../layouts/footer.php'; ?>