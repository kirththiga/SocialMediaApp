<!-- Left Column: Profile Info -->
<div class="col-md-3">
    <!-- Profile Picture https://via.placeholder.com/150-->
    <img src="<?= $user['profile_pic'] ? htmlspecialchars($user['profile_pic']) : '' ?>" 
            alt="Profile Picture" 
            class="profile-pic mb-3">

    <!-- Full Name -->
    <h3><?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?></h3>
    <p class="text-muted">@<?= htmlspecialchars($user['username']) ?></p>

    <p><strong>Email:</strong><br><?= htmlspecialchars($user['email']) ?></p>
    <p><strong>Gender:</strong><br><?= htmlspecialchars(ucfirst($user['gender'])) ?></p>

    <?php if ($user['birth_date']): ?>
        <p><strong>Birthday:</strong><br><?= date('F j', strtotime($user['birth_date'])) ?></p>
        <p><strong>Birth Year:</strong><br><?= date('Y', strtotime($user['birth_date'])) ?></p>
    <?php else: ?>
        <p><strong>Birth Date:</strong> -</p>
    <?php endif; ?>

    <p><strong>Location:</strong><br><?= htmlspecialchars($user['location']) ?></p>
    <p><strong>Bio:</strong><br><?= nl2br(htmlspecialchars($user['bio'])) ?></p>
</div>