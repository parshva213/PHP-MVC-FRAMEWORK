<div class="card">
    <div class="card-body">
        <form action="" method="post">
            <input type="hidden" name="uid" value="<?= $_GET['uid'] ?>">
            <div class="mb-3">
                <div class="input-group">
                    <label for="company_name">Company Name</label>
                </div>
                <div class="input-group">
                    <input type="text" class="form-control<?php echo $model->hasError('company_name') ? ' is-invalid' : '' ?>" id="company_name" name="company_name" placeholder="Company Name" value="<?= htmlspecialchars($model->company_name) ?>">
                </div>
                <?php if ($model->hasError('company_name')): ?>
                    <div class="input-group">
                        <div class="text-danger small ms-1" id="error">
                            <?php echo $model->getFirstError('company_name'); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <div class="input-group">
                    <label for="company_address">Company Address</label>
                </div>
                <div class="input-group">
                    <textarea name="company_address" id="company_address" class="form-control<?php echo $model->hasError('company_address') ? ' is-invalid' : '' ?>" placeholder="Company Address"><?= htmlspecialchars($model->company_address) ?></textarea>
                </div>
                <?php if ($model->hasError('company_address')): ?>
                    <div class="input-group">
                        <div class="text-danger small ms-1" id="error">
                            <?php echo $model->getFirstError('company_address'); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <div class="input-group">
                    <label for="gst_no">GST Number</label>
                </div>
                <div class="input-group">
                    <input type="text" class="form-control<?php echo $model->hasError('gst_no') ? ' is-invalid' : '' ?>" id="gst_no" name="gst_no" placeholder="GST Number" value="<?= htmlspecialchars($model->gst_no) ?>">
                </div>
                <?php if ($model->hasError('gst_no')): ?>
                    <div class="input-group">
                        <div class="text-danger small ms-1" id="error">
                            <?php echo $model->getFirstError('gst_no'); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="mb-3 text-center">
                <button type="submit" class="btn btn-success">Add Company</button>
            </div>
        </form>
    </div>
</div>