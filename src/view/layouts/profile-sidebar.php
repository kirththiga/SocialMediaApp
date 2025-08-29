<!-- Left Column: Profile Info -->
<div class="col-md-3">
    <div class="profile-sidebar p-3 mt-4 sticky-top">
        <?php if ($user['profile_pic']): ?>
            <div class="text-center mb-3">
                <img src="<?= htmlspecialchars($user['profile_pic']) ?>" 
                     alt="Profile Picture" 
                     class="profile-pic">
            </div>
        <?php endif; ?>

        <!-- Full Name + Username -->
        <h4 class="text-center mb-1"><?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?></h4>
        <p class="text-center text-muted mb-3">@<?= htmlspecialchars($user['username']) ?></p>

        <div class="text-center mb-3">
            <a href="index.php?action=edit_profile&user_id=<?= $user['id'] ?>" 
               class="btn btn-sm btn-outline-primary">
                Edit Profile
            </a>
        </div>
        <hr>

        <!-- Profile info with icons -->
        <ul class="list-unstyled profile-info">
            <li><i class="bi bi-envelope-fill me-2 text-primary"></i><?= htmlspecialchars($user['email']) ?></li>
            <li><i class="bi bi-gender-ambiguous me-2 text-secondary"></i><?= htmlspecialchars(ucfirst($user['gender'])) ?></li>
            <?php if ($user['birth_date']): ?>
                <li><i class="bi bi-cake2-fill me-2 text-danger"></i><?= date('F j', strtotime($user['birth_date'])) ?></li>
                <li><i class="bi bi-calendar-event-fill me-2 text-warning"></i><?= date('Y', strtotime($user['birth_date'])) ?></li>
            <?php else: ?>
                <li><i class="bi bi-cake2-fill me-2 text-danger"></i> -</li>
            <?php endif; ?>
            <li><i class="bi bi-geo-alt-fill me-2 text-success"></i><?= htmlspecialchars($user['location']) ?></li>

            <!-- Add see more/less if bio length is greater than 100 -->
            <?php $bio = htmlspecialchars($user['bio']); ?>
            <li class="bio-item">
                <i class="bi bi-info-circle-fill me-2 text-info"> Bio:</i>
                <span id="bio"><?= nl2br($bio) ?></span>
                <?php if (strlen(strip_tags($bio)) > 100): ?>
                    <a href="javascript:void(0)" id="toggleBio" class="text-primary small mt-1 d-block">See more</a>
                <?php endif; ?>
            </li>
        </ul>
    </div>
</div>