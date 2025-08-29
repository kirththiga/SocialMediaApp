<!-- Left Column: Profile Info -->
<div class="col-md-3 d-flex justify-content-center">
    <aside class="profile-sidebar card card-elevated">
        <div class="profile-header">
            <?php if (!empty($user['profile_pic'])): ?>
                <img
                        src="<?= htmlspecialchars($user['profile_pic']) ?>"
                        alt="Profile Picture"
                        class="profile-avatar"
                >
            <?php else: ?>
                <div class="profile-avatar placeholder">
                    <?= strtoupper(substr($user['first_name'] ?? 'U', 0, 1)) ?>
                </div>
            <?php endif; ?>

            <h3 class="profile-name">
                <?= htmlspecialchars(($user['first_name'] ?? '') . ' ' . ($user['last_name'] ?? '')) ?>
            </h3>
            <p class="profile-username">@<?= htmlspecialchars($user['username'] ?? '') ?></p>

            <!-- Bootstrap Blue Edit Button -->
            <a href="<?= BASE_URL ?>/index.php?controller=profile&action=edit_profile&user_id=<?= (int)$user['id'] ?>"
               class="btn btn-primary btn-sm w-100 mt-2">
                Edit Profile
            </a>
        </div>

        <hr class="profile-divider">

        <ul class="profile-meta list-unstyled">
            <li>
                <span class="meta-label">Email</span>
                <span class="meta-value"><?= htmlspecialchars($user['email'] ?? '') ?></span>
            </li>
            <li>
                <span class="meta-label">Gender</span>
                <span class="meta-value"><?= htmlspecialchars(ucfirst($user['gender'] ?? '')) ?></span>
            </li>
            <li>
                <span class="meta-label">Birthday</span>
                <span class="meta-value">
          <?php if (!empty($user['birth_date'])): ?>
              <?= date('F j, Y', strtotime($user['birth_date'])) ?>
          <?php else: ?>
              —
          <?php endif; ?>
        </span>
            </li>
            <li>
                <span class="meta-label">Location</span>
                <span class="meta-value"><?= htmlspecialchars($user['location'] ?? '') ?></span>
            </li>
        </ul>

        <?php if (!empty($user['bio'])): ?>
            <hr class="profile-divider">
            <div class="profile-bio">
                <div class="meta-label mb-1">Bio</div>
                <p class="bio-text mb-0">
                    <?= nl2br(htmlspecialchars($user['bio'])) ?>
                </p>
                <button class="btn btn-link p-0 mt-1 bio-toggle" type="button">See more</button>
            </div>
        <?php endif; ?>
    </aside>
</div>