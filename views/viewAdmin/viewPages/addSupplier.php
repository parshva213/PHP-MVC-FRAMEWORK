<?php
$this->title = 'Add Supplier';
$c = 0;
?>
<div class="mb-3 d-flex justify-content-evenly">
    <button type="button" class="btn btn-light" onclick="location.href='/adminSupplierList'">
        <span class="bi bi-arrow-left"></span>
    </button>
    <h1 class="text-center">Add Supplier</h1>
</div>
<form action="" method="post">
    <div class="mb-3">
        <div class="input-group">
            <label for="name" class="fs-3">Name</label>
        </div>
        <div class="input-group">
            <div class="input-group-text"><span class="bi bi-person"></span></div>
            <input type="text" class="form-control<?= $model->hasError('firstname') ? ' is-invalid' : '' ?>" id="firstname" name="firstname" placeholder="First Name" value="<?= htmlspecialchars($model->firstname) ?>">
            <input type="text" name="lastname" id="lastname" class="form-control<?= $model->hasError('lastname') ? ' is-invalid' : '' ?>" placeholder="Last Name" value="<?= htmlspecialchars($model->lastname) ?>">
        </div>
        <div class="input-group">
            <?php if ($model->hasError('firstname')): $c = 1; ?>
                <div class="text-danger small ms-1"><?= $model->getFirstError('firstname') ?></div>
            <?php else: $c = 0; ?>
            <?php endif; ?>
            <?php if ($model->hasError('lastname') && $c === 0): ?>
                <div class="text-danger small ms-1"><?= $model->getFirstError('lastname') ?></div>
            <?php endif; ?>
        </div>
    </div>
    <div class="mb-3">
        <div class="input-group">
            <label for="email" class="fs-3">Email</label>
        </div>
        <div class="input-group">
            <div class="input-group-text"><span class="bi bi-envelope"></span></div>
            <input type="email" class="form-control<?= $model->hasError('email') ? ' is-invalid' : '' ?>" id="email" name="email" placeholder="Email" value="<?= htmlspecialchars($model->email) ?>">
        </div>
        <div class="input-group">
            <?php if ($model->hasError('email')): ?>
                <div class="text-danger small ms-1"><?= $model->getFirstError('email') ?></div>
            <?php endif; ?>
        </div>
    </div>
    <div class="mb-3">
        <div class="input-group">
            <label for="contact" class="fs-3">Phone Number</label>
        </div>
        <div class="input-group">
            <div class="input-group-text"><span class="bi bi-phone"></span></div>
            <input type="text" class="form-control<?= $model->hasError('contact') ? ' is-invalid' : '' ?>" id="contact" name="contact" placeholder="Phone Number" value="<?= htmlspecialchars($model->contact) ?>">
        </div>
        <div class="input-group">
            <?php if ($model->hasError('contact')): ?>
                <div class="text-danger small ms-1"><?= $model->getFirstError('contact') ?></div>
            <?php endif; ?>
        </div>
    </div>
    <div class="mb-3">
        <div class="input-group">
            <label for="address" class="fs-3">Address</label>
        </div>
        <div class="input-group">
            <div class="input-group-text"><span class="bi bi-house"></span></div>
            <textarea name="address" id="address" class="form-control<?= $model->hasError('address') ? ' is-invalid' : '' ?>" placeholder="Address"><?= htmlspecialchars($model->address) ?></textarea>
        </div>
        <div class="input-group">
            <?php if ($model->hasError('address')): ?>
                <div class="text-danger small ms-1"><?= $model->getFirstError('address') ?></div>
            <?php endif; ?>
        </div>
    </div>
    <div class="mb-3">
        <div class="input-group">
            <input type="submit" class="btn btn-success ms-auto" value="Add Supplier">
        </div>
    </div>
</form>