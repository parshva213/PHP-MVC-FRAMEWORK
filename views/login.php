<?php
$this->title = 'Login';
?>

<!-- login.html -->

<body class="login-page bg-body-secondary">
  <div class="login-box mx-auto">
    <div class="login-logo">
      <a class="btn btn-outline-primary" href="/" role="button">
        <span class="bi bi-arrow-left">
        </span>
      </a>
      <a href="#"><b>HARDIK</b>TRADERS</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <form action="" method="post" id="loginform">
          <!-- Username Field -->
          <div class="mb-3">
            <div class="input-group">
              <div class="input-group-text"><span>@</span></div>
              <input
                type="text"
                class="form-control <?= $model->hasError('username') ? 'is-invalid' : '' ?>"
                placeholder="Username"
                name="username"
                id="username"
                value="<?= htmlspecialchars($model->username) ?>" />
            </div>
            <?php if ($model->hasError('username')): ?>
              <div class="text-danger small ms-1"><?= $model->getFirstError('username') ?></div>
            <?php endif; ?>
          </div>

          <!-- Password Field -->
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

          <!-- Remember Me & Submit -->
          <div class="row">
            <div class="col-8">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="flexCheckDefault" name="remember" />
                <label class="form-check-label" for="flexCheckDefault">Remember Me</label>
              </div>
            </div>
            <div class="col-4">
              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-outline-success">Sign In</button>
              </div>
            </div>
          </div>
        </form>

        <p class="mb-1"><a href="forgot-password.html">I forgot my password</a></p>
        <p class="mb-0">
          <a href="/register" class="text-center">Register a new membership</a>
        </p>
      </div>
    </div>
  </div>
</body>