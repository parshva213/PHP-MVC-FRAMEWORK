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
                        <button type="button" class="btn btn-sm btn-warning edit-field" data-work="supplierDetailFetch" data-uid="<?= htmlspecialchars($supplier['uid']) ?>" data-bs-toggle="modal" data-bs-target="#supplierEditModal">
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
                    placeholder="User ID"
                    name="uid"
                    id="uid" />
                <div class="mb-3 firstname lastname">
                    <div class="input-group">
                        <label for="name" class="fs-3">Name</label>
                    </div>
                    <div class="input-group">
                        <div class="input-group-text"><span class="bi bi-person"></span></div>
                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" value="<?= htmlspecialchars($model->firstname) ?>">
                        <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Last Name" value="<?= htmlspecialchars($model->lastname) ?>">
                    </div>
                    <div class="input-group">
                        <div class="text-danger small ms-1" id="error"></div>
                    </div>
                </div>
                <div class="mb-3 email">
                    <div class="input-group">
                        <label for="email" class="fs-3">Email</label>
                    </div>
                    <div class="input-group">
                        <div class="input-group-text"><span class="bi bi-envelope"></span></div>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?= htmlspecialchars($model->email) ?>">
                    </div>
                    <div class="input-group">
                        <div class="text-danger small ms-1" id="error"></div>
                    </div>
                </div>
                <div class="mb-3 contact">
                    <div class="input-group">
                        <label for="contact" class="fs-3">Phone Number</label>
                    </div>
                    <div class="input-group">
                        <div class="input-group-text"><span class="bi bi-phone"></span></div>
                        <input type="text" class="form-control" id="contact" name="contact" placeholder="Phone Number" value="<?= htmlspecialchars($model->contact) ?>">
                    </div>
                    <div class="input-group">
                        <div class="text-danger small ms-1" id="error"></div>
                    </div>
                </div>
                <div class="mb-3 address">
                    <div class="input-group">
                        <label for="address" class="fs-3">Address</label>
                    </div>
                    <div class="input-group">
                        <div class="input-group-text"><span class="bi bi-house"></span></div>
                        <textarea name="address" id="address" class="form-control" placeholder="Address"><?= htmlspecialchars($model->address) ?></textarea>
                    </div>
                    <div class="input-group">
                        <div class="text-danger small ms-1" id="error"></div>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('body').on('click', '.edit-field', function(e) {
            e.preventDefault();
            const uid = $(this).data('uid');
            const work = $(this).data('work');

            $.ajax({
                url: '/adminSupplierpage',
                type: 'GET',
                data: {
                    uid: uid,
                    work: work
                },
                success: function(response) {
                    // alert('Response received.');
                    console.log(response);
                    if (response.record) {
                        $('#supplier-' + response.uid).find('.product-state').replaceWith(response.record);
                    }
                    if (response.supplierDetailFetch) {
                        alert('Supplier details fetched successfully.');
                        const data = response.supplierDetailFetch;
                        console.log(response.supplierDetailFetch);
                        $('#uid').val(data.uid);
                        $('#firstname').val(data.firstname);
                        $('#lastname').val(data.lastname);
                        $('#email').val(data.email);
                        $('#contact').val(data.contact);
                        $('#address').val(data.address);

                        $('#error').css('display', 'none');

                    }
                },
                error: function(xhr) {
                    alert('Error: ' + xhr.responseText);
                }
            });
        });
    });
</script>