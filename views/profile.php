<?php

use models\ProfileForm;

$this->title = "profile";

$c = 0;

?>

<div class="login-box mx-auto">
    <div class="login-logo">
        <p><b>PROFILE</b> UPDATE</p>
    </div>
    <!-- /.profile-logo -->
    <div class="card">
        <!-- Name update -->
        <div class="card-body">
            <form action="" method="post" id="profilenameform">
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
                <!-- Email Change -->
                <div class="mb-3">
                    <div class="input-group">
                        <div class="input-group-text"><span class="bi bi-envelope"></span></div>
                        <input
                            type="text"
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
                    <?php if ($model->hasError('contact')): ?>
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
                    <button type="submit" class="btn btn-primary btn-lg rounded-pill">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>