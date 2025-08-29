<?php

include __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../../security/csrf.php';

?>
    <div class="container-fluid d-flex align-items-center justify-content-center" style="min-height: 80vh;">
        <div class="row justify-content-center w-100">
            <div class="col-12 col-sm-8 col-md-6 col-lg-4" style="max-width: 500px;">
                <div class="card shadow-sm border-0 rounded-3 mx-auto">
                    <div class="card-body p-4">
                        <h3 class="text-center mb-4">Register</h3>

                        <?php if (!empty($errors)): ?>
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    <?php foreach ($errors as $e): ?>
                                        <li><?= htmlspecialchars($e) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <form method="post" action="<?= BASE_URL ?>/index.php?controller=auth&action=register" novalidate>
                            <?= csrf_input('register_form') ?>
                            <div class="mb-3">
                                <input type="text" name="first_name" class="form-control"
                                       placeholder="First Name" required
                                       value="<?= htmlspecialchars($_POST['first_name'] ?? '') ?>">
                            </div>
                            <div class="mb-3">
                                <input type="text" name="last_name" class="form-control"
                                       placeholder="Last Name" required
                                       value="<?= htmlspecialchars($_POST['last_name'] ?? '') ?>">
                            </div>
                            <div class="mb-3">
                                <input type="text" name="username" class="form-control"
                                       placeholder="Username" required
                                       value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
                            </div>
                            <div class="mb-3">
                                <input type="email" name="email" class="form-control"
                                       placeholder="Email" required
                                       value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                            </div>

                            <div class="mb-3">
                                <input type="password" name="password" class="form-control"
                                       placeholder="Password" required>
                            </div>
                            <div class="mb-3">
                                <input type="password" name="confirm_password" class="form-control"
                                       placeholder="Confirm Password" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label d-block mb-1">Gender</label>
                                <div class="d-flex gap-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="genderMale"
                                               value="male" required
                                                <?= (($_POST['gender'] ?? '') === 'male') ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="genderMale">Male</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="genderFemale"
                                               value="female" required
                                                <?= (($_POST['gender'] ?? '') === 'female') ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="genderFemale">Female</label>
                                    </div>
                                </div>
                            </div>

                            <!-- birthday -->
                            <div class="mb-3">
                                <label class="form-label">Birth Date</label>
                                <input type="text"
                                       id="birthDate"
                                       name="birth_date"
                                       class="form-control"
                                       placeholder="Select your birth date"
                                       required
                                       value="<?= htmlspecialchars($_POST['birth_date'] ?? '') ?>">
                            </div>

                            <!-- Flatpickr CSS & JS (CDN) -->
                            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
                            <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
                            <script>
                                flatpickr("#birthDate", {
                                    dateFormat: "Y-m-d",
                                    maxDate: "today",
                                    defaultDate: "1990-01-01",
                                    altInput: true,
                                    altFormat: "F j, Y",
                                    yearRange: [1900, new Date().getFullYear()]
                                });
                            </script>

                            <button type="submit" class="btn btn-primary w-100">Register</button>
                        </form>
                    </div>
                </div>

                <p class="text-center mt-3">
                    Already have an account?
                    <a href="<?= BASE_URL ?>/index.php?controller=auth&action=login">Login</a>
                </p>
            </div>
        </div>
    </div>
<?php include __DIR__ . '/../layouts/main.php' ?>