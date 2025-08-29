<?php include __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../../security/csrf.php'; ?>

    <div class="container-fluid d-flex align-items-center justify-content-center" style="min-height: 80vh;">
        <div class="row justify-content-center w-100">
            <div class="col-12 col-sm-8 col-md-6 col-lg-4" style="max-width: 400px;">
                <div class="card shadow-sm border-0 rounded-3 mx-auto">
                    <div class="card-body p-4">
                        <h3 class="text-center mb-4">Login</h3>

                        <?php if (!empty($error)): ?>
                            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                        <?php endif; ?>

                        <form method="post" action="<?= BASE_URL ?>/index.php?controller=auth&action=login">
                            <?= csrf_input('login_form') ?>
                            <div class="mb-3">
                                <input type="email" name="email" class="form-control" placeholder="Email" required>
                            </div>
                            <div class="mb-3">
                                <input type="password" name="password" class="form-control" placeholder="Password"
                                       required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>
                    </div>
                </div>

                <p class="text-center mt-3">
                    Don’t have an account?
                    <a href="<?= BASE_URL ?>/index.php?controller=auth&action=register">Register</a>
                </p>
            </div>
        </div>
    </div>

<?php include __DIR__ . '/../layouts/main.php' ?>