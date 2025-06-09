<?php
$this->title = "Company Bank Details Form";
?>
<div class="card">
    <div class="card-body">
        <form action="" method="post">
            <input type="hidden" name="company_id" value="<?= $_GET['company_id'] ?>">
            <div class="mb-3" id="bank_name">
                <div class="input-group">
                    <label for="bank_name">Bank Name</label>
                </div>
                <div class="input-group">
                    <input type="text" name="bank_name" id="bank_name" class="form-control<?= $model->hasError('bank_name') ? ' is-invalid' : '' ?>" value="<?= $model->bank_name ?>" placeholder="Bank Name">
                </div>
                <?php if ($model->hasError('bank_name')): ?>
                    <div class="input-group">
                        <div class="text-danger small ms-1" id="error">
                            <?php echo $model->getFirstError('bank_name'); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <div class="input-group">
                    <label for="acc_hol_name">Account Holder Name</label>
                </div>
                <div class="input-group">
                    <input type="text" name="acc_hol_name" id="acc_hol_name" class="form-control<?= $model->hasError('acc_hol_name') ? ' is-invalid' : '' ?>" value="<?= $model->acc_hol_name ?>" placeholder="Account Holder Name">
                </div>
                <?php if ($model->hasError('acc_hol_name')): ?>
                    <div class="input-group">
                        <div class="text-danger small ms-1" id="error">
                            <?php echo $model->getFirstError('acc_hol_name'); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <div class="input-group">
                    <label for="acc_no">Account Number</label>
                </div>
                <div class="input-group">
                    <input type="text" name="acc_no" id="acc_no" class="form-control<?= $model->hasError('acc_no') ? ' is-invalid' : '' ?>" value="<?= $model->acc_no ?>" placeholder="Account Number">
                </div>
                <?php if ($model->hasError('acc_no')): ?>
                    <div class="input-group">
                        <div class="text-danger small ms-1" id="error">
                            <?php echo $model->getFirstError('acc_no'); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <div class="input-group">
                    <label for="bank_ifsc">Bank IFSC Code</label>
                </div>
                <div class="input-group">
                    <input type="text" name="bank_ifsc" id="bank_ifsc" class="form-control<?= $model->hasError('bank_ifsc') ? ' is-invalid' : '' ?>" value="<?= $model->bank_ifsc ?>" placeholder="Bank IFSC Code">
                </div>
                <?php if ($model->hasError('bank_ifsc')): ?>
                    <div class="input-group">
                        <div class="text-danger small ms-1" id="error">
                            <?php echo $model->getFirstError('bank_ifsc'); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <div class="input-group">
                    <label for="bank_branch">Branch Name</label>
                </div>
                <div class="input-group">
                    <input type="text" name="bank_branch" id="bank_branch" class="form-control<?= $model->hasError('bank_branch') ? ' is-invalid' : '' ?>" value="<?= $model->bank_branch ?>" placeholder="Branch Name">
                </div>
                <?php if ($model->hasError('bank_branch')): ?>
                    <div class="input-group">
                        <div class="text-danger small ms-1" id="error">
                            <?php echo $model->getFirstError('bank_branch'); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="mb-3 text-center">
                <button type="submit" class="btn btn-success">Add Bank Details</button>
            </div>
        </form>
    </div>
</div>
<!-- http://localhost:8081/adminsupplierCompanyBankDetail?uid=8&company_id=3 -->