<?php
$this->title = 'Change Password';
?>

<!-- login.html -->

<body class="login-page bg-body-secondary">
    <div class="login-box mx-auto">
        <div class="login-logo">
            <b>Change</b> Password
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <form action="" method="post" id="loginpasswordchange">
                    <!-- Current Password Field -->
                    <div class="mb-3">
                        <div class="input-group">
                            <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
                            <input
                                type="password"
                                class="form-control <?= $model->hasError('current_password') ? 'is-invalid' : '' ?>"
                                placeholder="Current Password"
                                name="current_password"
                                id="current_password"
                                value="<?= htmlspecialchars($model->current_password) ?>" />
                        </div>
                        <?php if ($model->hasError('current_password')): ?>
                            <div class="text-danger small ms-1"><?= $model->getFirstError('current_password') ?></div>
                        <?php endif; ?>
                    </div>
                    <!-- New Password -->
                    <div class="mb-3">
                        <div class="input-group">
                            <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
                            <input
                                type="password"
                                class="form-control <?= $model->hasError('password') ? 'is-invalid' : '' ?>"
                                placeholder="Password"
                                name="password"
                                id="password"
                                value="<?= htmlspecialchars($model->password) ?>" />
                        </div>
                        <?php if ($model->hasError('password')): ?>
                            <div class="text-danger small ms-1"><?= $model->getFirstError('password') ?></div>
                        <?php endif; ?>
                    </div>
                    <!-- conform Password -->
                    <div class="mb-3">
                        <div class="input-group">
                            <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
                            <input
                                type="password"
                                class="form-control <?= $model->hasError('conform_password') ? 'is-invalid' : '' ?>"
                                placeholder="conform_password"
                                name="conform_password"
                                id="conform_password"
                                value="<?= htmlspecialchars($model->conform_password) ?>" />
                        </div>
                        <?php if ($model->hasError('conform_password')): ?>
                            <div class="text-danger small ms-1"><?= $model->getFirstError('conform_password') ?></div>
                        <?php endif; ?>
                    </div>
                    <!-- Remember Me & Submit -->
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-outline-success">Change Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>