<?php
$this->title = 'Login';
?>

<!-- login.html -->

<body class="login-page bg-body-secondary">
    <div class="login-box mx-auto">
        <div class="login-logo">
            <a class="btn btn-outline-primary" href="/login" role="button">
                <span class="bi bi-arrow-left">
                </span>
            </a>
            <a href="#"><b>HARDIK</b>TRADERS</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <form action="" method="post" id="loginform">
                    <!-- select unique identifier Field with value -->
                    <div class="mb-3">
                        <div class="input-group">
                            <div class="input-group-text"><span class="bi bi-type"></span></div>
                            <select name="identifier" id="identifier" class="form-control <?= $model->hasError('identifier') ? 'is-invalid' : '' ?>">
                                <option value="" <?= $model->identifier === '' ? 'selected' : '' ?> disabled>Select element that you provide </option>
                                <option value="username" <?= $model->identifier === 'username' ? 'selected' : '' ?>>Username</option>
                                <option value="email" <?= $model->identifier === 'email' ? 'selected' : '' ?>>Email</option>
                                <option value="contact" <?= $model->identifier === 'contact' ? 'selected' : '' ?>>Comtact</option>
                            </select>
                            <input
                                type="text"
                                class="form-control <?= $model->hasError('val') ? 'is-invalid' : '' ?>"
                                placeholder="Put Value"
                                name="val"
                                id="val"
                                value="<?= htmlspecialchars($model->val) ?>" />
                        </div>
                        <?php if ($model->hasError('val')): ?>
                            <div class="text-danger small ms-1"><?= $model->getFirstError('val') ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Password Field -->
                    <div class="mb-3">
                        <div class="input-group">
                            <div class="input-group-text"><span class="bi bi-lock"></span></div>
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

                    <!-- Conform Password Field -->
                    <div class="mb-3">
                        <div class="input-group">
                            <div class="input-group-text"><span class="bi bi-lock"></span></div>
                            <input
                                type="password"
                                class="form-control <?= $model->hasError('conform_password') ? 'is-invalid' : '' ?>"
                                placeholder="Retype Password"
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