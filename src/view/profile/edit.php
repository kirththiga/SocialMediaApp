<?php include __DIR__.'/../layouts/header.php'; ?>

<h2>Edit Profile</h2>

<form method="POST" action="index.php?action=edit_profile&user_id=<?= $user['id'] ?>" enctype="multipart/form-data">

    <div class="mb-3">
        <label>First Name</label>
        <input type="text" name="first_name" class="form-control" value="<?= htmlspecialchars($user['first_name']) ?>">
    </div>

  
    <div class="mb-3">
        <label>Last Name</label>
        <input type="text" name="last_name" class="form-control" value="<?= htmlspecialchars($user['last_name']) ?>">
    </div>

    <div class="mb-3">
        <label>Username</label>
        <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($user['username']) ?>">
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>">
    </div>

    <div class="mb-3">
        <label>Location</label>
        <input type="text" name="location" class="form-control" value="<?= htmlspecialchars($user['location']) ?>">
    </div>

    <div class="mb-3">
        <label>Gender</label>
        <select name="gender" class="form-control">
            <option value="">Select</option>
            <option value="male" <?= $user['gender']=='male'?'selected':'' ?>>Male</option>
            <option value="female" <?= $user['gender']=='female'?'selected':'' ?>>Female</option>
            <option value="other" <?= $user['gender']=='other'?'selected':'' ?>>Other</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Birth Date</label>
        <input type="date" name="birth_date" class="form-control" value="<?= htmlspecialchars($user['birth_date']) ?>">
    </div>

    <div class="mb-3">
        <label>Bio</label>
        <textarea name="bio" class="form-control"><?= htmlspecialchars($user['bio']) ?></textarea>
    </div>

    <div class="mb-3">
        <label>Profile Picture</label>
        <input type="file" name="profile_pic" class="form-control">
        <?php if ($user['profile_pic']): ?>
            <img src="<?= htmlspecialchars($user['profile_pic']) ?>" alt="Profile Picture" class="mt-2" width="100">
        <?php endif; ?>
    </div>

    <button type="submit" class="btn btn-primary">Update Profile</button>
    <a href="index.php?action=profile&user_id=<?= $user['id'] ?>" class="btn btn-secondary">Cancel</a>
</form>

 <?php include __DIR__.'/../layouts/footer.php'; ?>