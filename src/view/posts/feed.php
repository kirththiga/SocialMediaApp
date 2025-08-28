<?php include __DIR__.'/../layouts/header.php'; ?>

<div class="row">
    <!-- Left Column: Profile Info -->
    <?php include __DIR__.'/../layouts/profile-sidebar.php'; ?>

    <!-- Right Column: Post Form & Posts -->
    <div class="col-md-9">
        <!-- Tabs for Posts / Feed -->
        <ul class="nav nav-tabs mb-3">
            <li class="nav-item">
                <a class="nav-link" href="index.php?controller=profile&action=index">My Posts</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#">Feed</a>
            </li>
        </ul>

        <!-- Posts List -->
        <?php if ($posts): ?>
            <?php foreach ($posts as $post): ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
                        <small class="text-muted">
                            Posted on <?= date("F j, Y g:i A", strtotime($post['created_at'])) ?> by <?= $post['username'] ?>
                            <?php if (!empty($post['updated_at'])): ?>
                                <br><em>(Edited on <?= date("F j, Y g:i A", strtotime($post['updated_at'])) ?>)</em>
                            <?php endif; ?>
                        </small>
                        <br>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No posts yet.</p>
        <?php endif; ?>
    </div>
</div>
 <?php include __DIR__.'/../layouts/footer.php'; ?>