<?php

use core\Application;
use core\Need;

$this->title = 'Supplier List';
$c = 0;
$usertype = Need::ROLE_SUPPLIER;

$db = Application::$app->db->pdo;
$sql = "SELECT * FROM ausers WHERE user_type = :user_type";
$stmt = $db->prepare($sql);
$stmt->bindValue(':user_type', $usertype);
$stmt->execute();
$suppliers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="ms-auto d-flex justify-content-end mb-3">
    <button type="button" class="btn btn-primary ms-auto" onclick="location.href='/adminSupplierAdd'">
        Add Supplier
    </button>
</div>
<?php if (count($suppliers) > 0) {
?>
    <div class="table-responsive">
        <table class="table table-striped supplier-table">
            <tr class="table-header">
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Address</th>
                <th>Edit</th>
                <th>Redirect</th>
            </tr>
            <?php
            $i = 1;
            foreach ($suppliers as $supplier) {
            ?>
                <tr id="supplier-<?= htmlspecialchars($supplier['uid']) ?>">
                    <td><?= $i++; ?></td>
                    <td><?= htmlspecialchars($supplier['firstname']) . ' ' . htmlspecialchars($supplier['lastname']) ?></td>
                    <td><?= htmlspecialchars($supplier['email']) ?></td>
                    <td><?= htmlspecialchars($supplier['contact']) ?></td>
                    <td><?= htmlspecialchars($supplier['address']) ?></td>
                    <td>
                        <button type="button" class="btn btn-sm btn-warning edit-field" data-work="supplierDetailFetch" data-pid="<?= htmlspecialchars($supplier['uid']) ?>" data-bs-toggle="modal" data-bs-target="#supplierEditModal">
                            Edit
                        </button>
                    </td>
                    <td>
                        <a href="/adminSupplierDelete?id=<?= $supplier['uid'] ?>" class="btn btn-sm btn-secondary">Delete</a>
                    </td>
                </tr>
            <?php
            } ?>
        </table>
    </div>
<?php
} else {
?>
    <div class="alert alert-info" role="alert">
        No suppliers found.
    </div>
<?php
}
?>

<div class="modal fade" id="supplierEditModal" tabindex="-1" aria-labelledby="supplierEditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Supplier</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- <form action="" method="get"> -->

                <input
                    type="hidden"
                    placeholder="Product ID"
                    name="pid"
                    id="pid"
                    value="<?= htmlspecialchars($model->pid) ?>" />
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
                <!-- </form> -->

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary update-field update-btn" data-work="Update-product">Update</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('body').on('click', '.edit-field', function(e) {
            e.preventDefault();
            const pid = $(this).data('pid');
            const work = $(this).data('work');

            $.ajax({
                url: '/adminSupplierEdit',
                type: 'GET',
                data: {
                    pid: pid,
                    work: work
                },
                success: function(response) {
                    if (response) {
                        if (response.record) {
                            $('#product-' + response.pid).find('.product-state').replaceWith(response.record);
                        }
                        if (response.UpdateFetch) {
                            const data = response.UpdateFetch;
                            $('#pid').val(data.pid);
                            $('#pname').val(data.pname);
                            $('#product_type').val(data.product_type);
                            $('#hsfno').val(data.hsfno);
                            $('#description').val(data.description);
                            $('#pstatus').val(data.pstatus);
                            $('#quantity').val(data.quantity);
                            $('#mrp').val(data.mrp);
                            $('#selling_price').val(data.selling_price);

                            $('#error').css('display', 'none');

                        }
                    }
                },
                error: function(xhr) {
                    alert('Error: ' + xhr.responseText);
                }
            });
        });
    });
</script>