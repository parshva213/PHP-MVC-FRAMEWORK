<?php
$this->title = 'Register';
$c = 0;
$cc = 0;
?>


<!-- register.html -->

<body class="register-page bg-body-secondary">
  <div class="register-box mx-auto">
    <div class="register-logo">
      <p><b>HARDIK</b> TRADERS</p>
    </div>
    <!-- /.register-logo -->
    <div class="card">
      <div class="card-body">
        <form action="" method="post" id="registrationform">
          <!-- Name -->
          <div class="mb-3">
            <div class="input-group">
              <div class="input-group-text"><span class="bi bi-person"></span></div>
              <input
                type="text"
                class="form-control <?= $model->hasError('firstName') ? 'is-invalid' : '' ?>"
                placeholder="First Name"
                name="firstName"
                id="firstName"
                value="<?= htmlspecialchars($model->firstName) ?>" />
              <input
                type="text"
                class="form-control <?= $model->hasError('lastName') ? 'is-invalid' : '' ?>"
                placeholder="Last Name"
                name="lastName"
                id="lastName"
                value="<?= htmlspecialchars($model->lastName) ?>" />
            </div>
            <?php if ($model->hasError('firstName')):  $c = 1; ?>
              <div class="text-danger small ms-1"><?= $model->getFirstError('firstName') ?></div>
            <?php else: $c = 0;
            endif; ?>
            <?php if ($model->hasError('lastName') && $c != 1): ?>
              <div class="text-danger small ms-1"><?= $model->getFirstError('lastName') ?></div>
            <?php endif; ?>
          </div>

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

          <!-- user_type Field -->
          <div class="mb-3">
            <div class="input-group">
              <div class="input-group-text"><span>Role</span></div>
              <select name="user_type" id="user_type" style="width: 82%;" class="form-control <?= $model->hasError('user_type') ? 'is-invalid' : '' ?>">
                <option value="" <?= $model->user_type === '' ? 'selected' : '' ?> disabled>Select your role</option>
                <option value="c" <?= $model->user_type === 'c' ? 'selected' : '' ?>>Customer</option>
                <option value="s" <?= $model->user_type === 's' ? 'selected' : '' ?>>Supplier</option>
                <option value=" m" <?= $model->user_type === 'm' ? 'selected' : '' ?>>Manufacturer</option>
              </select>
            </div>
            <?php if ($model->hasError('user_type')): ?>
              <div class="text-danger small ms-1"><?= $model->getFirstError('user_type') ?></div>
            <?php endif; ?>
          </div>

          <!-- Email Field -->
          <div class="mb-3">
            <div class="input-group">
              <div class="input-group-text"><span class="bi bi-envelope"></span></div>
              <input
                type="email"
                class="form-control <?= $model->hasError('email') ? 'is-invalid' : '' ?>"
                placeholder="Email"
                name="email"
                id="email"
                value="<?= htmlspecialchars($model->email) ?>" />
            </div>
            <?php if ($model->hasError('email')): ?>
              <div class="text-danger small ms-1"><?= $model->getFirstError('email') ?></div>
            <?php endif; ?>
          </div>

          <!-- conatct Field -->
          <div class="mb-3">
            <div class="input-group">
              <div class="input-group-text"><span class="bi bi-plus-lg"></span></div>
              <!-- Phone Number -->
              <input
                type=" tel"
                class="form-control <?= $model->hasError('contact') ? 'is-invalid' : '' ?>"
                placeholder="Phone Number"
                name="contact"
                id="contact"
                value="<?= htmlspecialchars($model->contact) ?>" />
            </div>

            <!-- Contact number error -->
            <?php if ($model->hasError('contact') && $cc != 1): ?>
              <div class="text-danger small ms-1"><?= $model->getFirstError('contact') ?></div>
            <?php endif; ?>
          </div>

          <!-- address -->
          <div class="mb-3">
            <div class="input-group">
              <div class="input-group-text"><span class="bi bi-pin-map"></span></div>
              <textarea
                class="form-control <?= $model->hasError('address') ? 'is-invalid' : '' ?>"
                placeholder="Shop-Name : Address"
                name="address"
                id="address"
                rows="5"
                cols="auto"><?= htmlspecialchars($model->address) ?></textarea>
            </div>
            <?php if ($model->hasError('address')): ?>
              <div class="text-danger small ms-1"><?= $model->getFirstError('address') ?></div>
            <?php endif; ?>
          </div>
          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary btn-lg rounded-pill">Register</button>
          </div>
        </form>
        <div class="text-center mt-3">
          <a href="/login" class="text-decoration-none">I already have a membership</a>
        </div>
      </div>
    </div>
  </div>
</body>