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
                            <span class="form-check edit-field form-switch">
                                <?php $isChecked = ($p['pstate'] == Need::PRODUCT_STATE_ACTIVE); ?>
                                <input
                                    data-pid="<?= htmlspecialchars($p['pid']) ?>"
                                    data-work="<?= $isChecked ? Need::PRODUCT_STATE_INACTIVE : Need::PRODUCT_STATE_ACTIVE ?>"
                                    class="form-check-input edit-field"
                                    type="checkbox"
                                    role="switch"
                                    <?= $isChecked ? 'checked' : '' ?> />

                            </span>
                        </td>
                        <td class="product-created"><?php echo $p['created_at'] ?></td>
                        <td class="product-updated"><?php echo $p['last_updated_at'] ?></td>
                        <td class="product-action">
                            <button type="button" class="btn btn-sm btn-warning edit-field" data-work="UpdateFetch" data-pid="<?= htmlspecialchars($p['pid']) ?>" data-bs-toggle="modal" data-bs-target="#staticBackdropedit">
                                Edit
                            </button>
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
                    <!-- <form action="" method="get"> -->

                    <input
                        type="hidden"
                        placeholder="Product Name"
                        name="pid"
                        id="pid"
                        value="<?= htmlspecialchars($model->pid) ?>" />
                    <!-- Product Name -->
                    <div class="mb-3 pname">
                        <label for="pname">Product Name</label>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Product Name"
                            name="pname"
                            id="pname"
                            value="<?= htmlspecialchars($model->pname) ?>" />
                        <div class="text-danger small ms-1" id="error"></div>
                    </div>

                    <!-- Product Type -->
                    <div class="mb-3 product_type">
                        <label for="product_type">Product Type</label>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Product Type"
                            name="product_type"
                            id="product_type"
                            value="<?= htmlspecialchars($model->product_type) ?>" />
                        <div class="text-danger small ms-1" id="error"></div>
                    </div>

                    <!-- HSF No -->
                    <div class="mb-3 hsfno">
                        <label for="hsfno">HSF No</label>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="HSF NO"
                            name="hsfno"
                            id="hsfno"
                            value="<?= htmlspecialchars($model->hsfno) ?>" />
                        <div class="text-danger small ms-1" id="error"></div>
                    </div>

                    <!-- Description -->
                    <div class="mb-3 description">
                        <label for="description">Description</label>
                        <textarea
                            class="form-control"
                            placeholder="Description"
                            name="description"
                            id="description"><?= htmlspecialchars($model->description) ?></textarea>
                        <div class="text-danger small ms-1" id="error"></div>
                    </div>

                    <!-- Product Status -->
                    <div class="mb-3 pstatus">
                        <label for="pstatus">Product Status</label>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Product Status"
                            name="pstatus"
                            id="pstatus"
                            value="<?= htmlspecialchars($model->pstatus) ?>" />
                        <div class="text-danger small ms-1" id="error"></div>
                    </div>

                    <!-- Quantity -->
                    <div class="mb-3 quantity">
                        <label for="quantity">Quantity</label>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Quantity"
                            name="quantity"
                            id="quantity"
                            value="<?= htmlspecialchars($model->quantity) ?>" />
                        <div class="text-danger small ms-1" id="error"></div>
                    </div>

                    <!-- MRP -->
                    <div class="mb-3 mrp">
                        <label for="mrp">MRP</label>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="MRP"
                            name="mrp"
                            id="mrp"
                            value="<?= htmlspecialchars($model->mrp) ?>" />
                        <div class="text-danger small ms-1" id="error"></div>
                    </div>

                    <!-- Selling Price -->
                    <div class="mb-3 selling_price">
                        <label for="selling_price">Selling Price</label>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Selling Price"
                            name="selling_price"
                            id="selling_price"
                            value="<?= htmlspecialchars($model->selling_price) ?>" />
                        <div class="text-danger small ms-1" id="error"></div>
                    </div>

                    <!-- </form> -->

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary update-field update-btn" data-work="Update-product">Update</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('body').on('click', '.update-field', function(e) {
            e.preventDefault();
            const work = $(this).data('work');
            const updatedata = {
                pid: $('#pid').val(),
                pname: $('#pname').val(),
                product_type: $('#product_type').val(),
                hsfno: $('#hsfno').val(),
                description: $('#description').val(),
                pstatus: $('#pstatus').val(),
                quantity: $('#quantity').val(),
                mrp: $('#mrp').val(),
                selling_price: $('#selling_price').val(),
            };
            $.ajax({
                url: '/adminProductGiveAccess',
                type: 'POST',
                data: {
                    data: updatedata,
                    work: work
                },
                success: function(response) {

                    if (response.attribute) {
                        // console.log(response.attribute);
                        const attribute = response.attribute;
                        Object.entries(attribute).forEach(attr => {
                            const fild = attr[1];
                            const row = $('.' + fild);
                            const classupdate = row.find('#' + fild);
                            const errorshow = row.find('#error');
                            classupdate.removeClass('is-invalid');
                            errorshow.replaceWith(`<div class="text-danger small ms-1" id="error"></div>`);
                        });
                    }
                    if (response.update_error) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: response.update_error,
                        });
                        return;
                    }
                    if (response.row) {
                        $('#product-' + response.pid).replaceWith(response.row);
                        $('#staticBackdropedit').css('display', 'none'); // ✅
                        $('#staticBackdropedit').removeClass('show'); // ✅
                        $('body').removeClass('modal-open'); // ✅
                        $('.modal-backdrop').remove(); // ✅
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Product Updated Successfully",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }

                    if (response.error) {
                        const updatedData = response.error;
                        Object.entries(updatedData).forEach(errorobj => {
                            errorobj = errorobj[1];
                            const fild = errorobj.ERRORKEY;
                            const value = errorobj.ERRORVAL;
                            const row = $('.' + fild);
                            const classupdate = row.find('#' + fild);
                            const errorshow = row.find('#error');
                            classupdate.addClass('is-invalid');
                            errorshow.replaceWith(`<div class="text-danger small ms-1" id="error">${value}</div>`);
                        });
                    }
                },
                error: function(xhr) {
                    alert('Error: ' + xhr.responseText);
                }
            });

        });
        // Handle both click and change for .status_check and .edit-field
        $('body').on('click change', '.edit-field', function(e) {
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


    document.addEventListener('DOMContentLoaded', function() {
        const textarea = document.getElementById('description');
        textarea.style.overflowY = 'hidden';
        textarea.addEventListener('input', function() {
            textarea.style.height = 'auto';
            textarea.style.height = textarea.scrollHeight + 'px';
        });
        textarea.dispatchEvent(new Event('input'));
    });
</script>