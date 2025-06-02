<?php


use core\Application;
use core\Need;

$this->title = 'Product View Action';

$db = Application::$app->db->pdo;

$products = $db->query("SELECT * FROM product")->fetchAll(PDO::FETCH_ASSOC);
?>
<h1 class="mt-4">Product View</h1>
<div class="table-responsive">
    <table class="table table-striped user-table" style="max-height: 75vh; margin:0 0 3vh 0;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Type</th>
                <th>HSF No</th>
                <th>Description</th>
                <th>User Name</th>
                <th>User Role</th>
                <th>Status</th>
                <th>Quantity</th>
                <th>MRP</th>
                <th>Selling Price</th>
                <th>State</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (count($products) > 0) {
                foreach ($products as $p) {
                    $role = ($p['user_type'] == "a") ?
                        "Admin" : (($p['user_type'] == "o") ?
                            "Owner" : (($p['user_type'] == "c") ?
                                "Customer" : (($p['user_type'] == "m") ?
                                    "Manufacturer" : (($p['user_type'] == "s") ?
                                        "Supplier" :
                                        ""))));
            ?>
                    <tr id="product-<?= htmlspecialchars($p['pid']) ?>">
                        <td class="product-pid"><?php echo $p['pid'] ?></td>
                        <td class="product-name"><?php echo $p['pname'] ?></td>
                        <td class="product-type"><?php echo $p['product_type'] ?></td>
                        <td class="product-hsfno"><?php echo $p['hsfno'] ?></td>
                        <td class="product-description"><?php echo $p['description'] ?></td>
                        <td class="product-uname"><?php echo $p['user_name'] ?></td>
                        <td class="product-user-role"><?php echo $role ?></td>
                        <td class="product-status"><?php echo $p['pstatus'] ?></td>
                        <td class="product-quantity"><?php echo $p['quantity'] ?></td>
                        <td class="product-mrp"><?php echo $p['mrp'] ?></td>
                        <td class="product-sp"><?php echo $p['selling_price'] ?></td>
                        <td class="product-state">
                            <span><?php echo $p['pstate'] ?></span>
                            <span class="form-check form-switch">
                                <?php $isChecked = ($p['pstate'] == Need::PRODUCT_STATE_ACTIVE); ?>
                                <input
                                    data-pid="<?= htmlspecialchars($p['pid']) ?>"
                                    data-state="<?= $isChecked ? Need::PRODUCT_STATE_INACTIVE : Need::PRODUCT_STATE_ACTIVE ?>"
                                    class="form-check-input status_check"
                                    type="checkbox"
                                    role="switch"
                                    <?= $isChecked ? 'checked' : '' ?> />

                            </span>
                        </td>
                        <td class="product-created"><?php echo $p['created_at'] ?></td>
                        <td class="product-updated"><?php echo $p['last_updated_at'] ?></td>
                        <td class="product-action dropdown">
                            <a href="#" class="text-black" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots-vertical"></i>
                            </a>
                            <ul class="dropdown-menu action-list">
                                <!-- Nested Dropdown Item -->
                                <li>
                                    <button type="button" class="dropdown-item text-success edit-field" data-work="UpdateFetch" data-pid="<?= htmlspecialchars($p['pid']) ?>" data-bs-toggle="modal" data-bs-target="#staticBackdropedit">
                                        Edit
                                    </button>
                                </li>
                            </ul>
                        </td>
                    </tr>
                <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="13" style="text-align: center; align-content:center;">products are not avalable</td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <div class="modal fade" id="staticBackdropedit" tabindex="-1" aria-labelledby="staticBackdropedit" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">

                        <!-- Product Name -->
                        <div class="mb-3">
                            <label for="pname">Product Name</label>
                            <input
                                type="text"
                                class="form-control <?= $model->hasError('pname') ? 'is-invalid' : '' ?>"
                                placeholder="Product Name"
                                name="pname"
                                id="pname"
                                value="<?= htmlspecialchars($model->pname) ?>" />
                            <?php if ($model->hasError('pname')): ?>
                                <div class="text-danger small ms-1"><?= $model->getFirstError('pname') ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- Product Type -->
                        <div class="mb-3">
                            <label for="product_type">Product Type</label>
                            <input
                                type="text"
                                class="form-control <?= $model->hasError('product_type') ? 'is-invalid' : '' ?>"
                                placeholder="Product Type"
                                name="product_type"
                                id="product_type"
                                value="<?= htmlspecialchars($model->product_type) ?>" />
                            <?php if ($model->hasError('product_type')): ?>
                                <div class="text-danger small ms-1"><?= $model->getFirstError('product_type') ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- HSF No -->
                        <div class="mb-3">
                            <label for="hsfno">HSF No</label>
                            <input
                                type="Number"
                                class="form-control <?= $model->hasError('hsfno') ? 'is-invalid' : '' ?>"
                                placeholder="HSF NO"
                                name="hsfno"
                                id="hsfno"
                                step="1"
                                value="<?= htmlspecialchars($model->hsfno) ?>" />
                            <?php if ($model->hasError('hsfno')): ?>
                                <div class="text-danger small ms-1"><?= $model->getFirstError('hsfno') ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description">Description</label>
                            <textarea
                                class="form-control <?= $model->hasError('description') ? 'is-invalid' : '' ?>"
                                placeholder="Description"
                                name="description"
                                id="description"><?= htmlspecialchars($model->description) ?></textarea>
                            <?php if ($model->hasError('description')): ?>
                                <div class="text-danger small ms-1"><?= $model->getFirstError('description') ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- Product Status -->
                        <div class="mb-3">
                            <label for="pstatus">Product Status</label>
                            <input
                                type="text"
                                class="form-control <?= $model->hasError('pstatus') ? 'is-invalid' : '' ?>"
                                placeholder="Product Status"
                                name="pstatus"
                                id="pstatus"
                                value="<?= htmlspecialchars($model->pstatus) ?>" />
                            <?php if ($model->hasError('pstatus')): ?>
                                <div class="text-danger small ms-1"><?= $model->getFirstError('pstatus') ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- Quantity -->
                        <div class="mb-3">
                            <label for="quantity">Quantity</label>
                            <input
                                type="number"
                                class="form-control <?= $model->hasError('quantity') ? 'is-invalid' : '' ?>"
                                placeholder="Quantity"
                                name="quantity"
                                id="quantity"
                                step="1"
                                value="<?= htmlspecialchars($model->quantity) ?>" />
                            <?php if ($model->hasError('quantity')): ?>
                                <div class="text-danger small ms-1"><?= $model->getFirstError('quantity') ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- MRP -->
                        <div class="mb-3">
                            <label for="mrp">MRP</label>
                            <input
                                type="number"
                                class="form-control <?= $model->hasError('mrp') ? 'is-invalid' : '' ?>"
                                placeholder="MRP"
                                name="mrp"
                                id="mrp"
                                step="0.01"
                                value="<?= htmlspecialchars($model->mrp) ?>" />
                            <?php if ($model->hasError('mrp')): ?>
                                <div class="text-danger small ms-1"><?= $model->getFirstError('mrp') ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- Selling Price -->
                        <div class="mb-3">
                            <label for="selling_price">Selling Price</label>
                            <input
                                type="number"
                                class="form-control <?= $model->hasError('selling_price') ? 'is-invalid' : '' ?>"
                                placeholder="Selling Price"
                                name="selling_price"
                                id="selling_price"
                                step="0.01"
                                value="<?= htmlspecialchars($model->selling_price) ?>" />
                            <?php if ($model->hasError('selling_price')): ?>
                                <div class="text-danger small ms-1"><?= $model->getFirstError('selling_price') ?></div>
                            <?php endif; ?>
                        </div>

                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('body').on('change', '.status_check', function(e) {
            e.preventDefault(); // stop default button action
            const pid = $(this).data('pid');
            const state = $(this).data('state');
            $.ajax({
                url: '/adminProductGiveAccess', // update to correct PHP script
                type: 'GET',
                data: {
                    pid: pid,
                    state: state
                },
                success: function(response) {
                    $('#product-' + response.pid).find('.product-state').replaceWith(response.record);
                    // $('#product-' + response.pid).find('.product-state input').html(response.record);
                    console.log(response.record);
                },
                error: function(xhr) {
                    alert('Error: ' + xhr.responseText);
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('body').on('click', '.edit-field', function(e) {
            e.preventDefault();
            const pid = $(this).data('pid');
            const work = $(this).data('work');
            $.ajax({
                url: '/adminProductGiveAccess',
                type: 'GET',
                data: {
                    pid: pid,
                    work: work
                },
                success: function(response) {
                    const data = response.fetchData;
                    $('#pname').val(data.pname);
                    $('#product_type').val(data.product_type);
                    $('#hsfno').val(data.hsfno);
                    $('#description').val(data.description);
                    $('#pstatus').val(data.pstatus);
                    $('#quantity').val(data.quantity);
                    $('#mrp').val(data.mrp);
                    $('#selling_price').val(data.selling_price);
                },
                error: function(xhr) {
                    alert('Error: ' + xhr.responseText);
                }
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const textarea = document.getElementById('description');
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            const maxHeight = parseInt(getComputedStyle(this).lineHeight) * 4;
            this.style.height = Math.min(this.scrollHeight, maxHeight) + 'px';
        });
        textarea.dispatchEvent(new Event('input'));
    });
</script>