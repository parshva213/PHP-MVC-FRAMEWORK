<?php

use core\Application;

if (isset($_GET['uid'])) {
    $uid = $_GET['uid'];
    $this->title = 'Supplier Detail ' . $uid;
} else {
    echo '<div class="alert alert-info" role="alert">
        No suppliers found.
    </div>';
    exit;
}
$db = Application::$app->db->pdo;
$stmt = "SELECT * FROM ausers WHERE uid = :uid";
$stmt = $db->prepare($stmt);
$stmt->bindValue(':uid', $uid);
$stmt->execute();
$supplier = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$supplier) {
    echo '<div class="alert alert-info" role="alert">
        No supplier found.
    </div>';
    exit;
}
?>
<div class="d-grid gap-5">
    <!-- supplier details  -->
    <div class="card supplier-detail-card">
        <div class="card-header text-center">
            <p><?php echo htmlspecialchars($supplier['firstname']) . ' ' . htmlspecialchars($supplier['lastname']); ?></p>
        </div>
        <div class="card-body d-flex justify-content-evenly">
            <p><strong>Email:</strong> <?php echo htmlspecialchars($supplier['email']); ?></p>
            <p><strong>Contact:</strong> <?php echo htmlspecialchars($supplier['contact']); ?></p>
            <p><strong>Address:</strong> <?php echo htmlspecialchars($supplier['address']); ?></p>
        </div>
        <div class="card-footer text-end">
            <button class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#supplierEditModal">Edit</button>
        </div>
    </div>
    <!-- company details -->
    <div class="company-view d-flex flex-column gap-3">
        <a href="/addSupplierCompany?uid=<?= htmlspecialchars($supplier['uid']) ?>" role="button" class="btn btn-outline-success ms-auto"><span class="bi bi-plus"></span>Add Company</a>

        <?php
        $stmt = $db->prepare("SELECT * FROM scompany where uid = :uid");
        $stmt->bindValue(':uid', $uid);
        $stmt->execute();
        $companies = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($companies) > 0) {
        ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Company ID</th>
                            <th>Company Name</th>
                            <th>Company Address</th>
                            <th>GST Number</th>
                            <th>Account Holder Name</th>
                            <th>Account Number</th>
                            <th>Bank IFSC Code</th>
                            <th>Bank Name</th>
                            <th>Bank Branch</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($companies as $company): ?>
                            <tr class="company-<?= htmlspecialchars($company['company_id']) ?>">
                                <td><?= htmlspecialchars($company['company_id']) ?></td>
                                <td><?= htmlspecialchars($company['company_name']) ?></td>
                                <td><?= htmlspecialchars($company['company_address']) ?></td>
                                <td><?= htmlspecialchars($company['gst_no']) ?></td>
                                <?php
                                $stmt = $db->prepare("SELECT * FROM scompanybank WHERE company_id = :company_id");
                                $stmt->bindValue(':company_id', $company['company_id']);
                                $stmt->execute();
                                $bankDetails = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                ?>
                                <?php if (count($bankDetails) > 0): ?>
                                    <?php foreach ($bankDetails as $bank): ?>
                                        <td><?= htmlspecialchars($bank['acc_hol_name']) ?></td>
                                        <td><?= htmlspecialchars($bank['acc_no']) ?></td>
                                        <td><?= htmlspecialchars($bank['bank_ifsc']) ?></td>
                                        <td><?= htmlspecialchars($bank['bank_name']) ?></td>
                                        <td><?= htmlspecialchars($bank['bank_branch']) ?></td>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                <td class="text-center dropdown">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li>
                                            <button type="button" class="dropdown-item btn btn-outline-secondary">Edit Company Details</button>
                                        </li>
                                        <li>
                                            <button type="button" class="dropdown-item btn btn-outline-secondary">Edit Bank Details</button>
                                        </li>
                                        <li>
                                            <button type="button" class="dropdown-item btn btn-outline-secondary">New Order</button>
                                        </li>
                                        <li>
                                            <button type="button" class="dropdown-item btn btn-outline-secondary">Order History</button>
                                        </li>
                                    </ul>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php
        }
        ?>
    </div>
    <!-- Supplier Edit Modal -->
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
                        id="uid"
                        value="<?= htmlspecialchars($supplier['uid']) ?>" />
                    <div class="mb-3 firstname lastname">
                        <div class="input-group">
                            <label for="name" class="fs-3">Name</label>
                        </div>
                        <div class="input-group">
                            <div class="input-group-text"><span class="bi bi-person"></span></div>
                            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" value="<?= htmlspecialchars($model->firstname === "" ? $supplier['firstname'] : $model->firstname) ?>">
                            <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Last Name" value="<?= htmlspecialchars($model->lastname === "" ? $supplier['lastname'] : $model->lastname) ?>">
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
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?= htmlspecialchars($model->email === "" ? $supplier['email'] : $model->email) ?>">
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
                            <input type="text" class="form-control" id="contact" name="contact" placeholder="Phone Number" value="<?= htmlspecialchars($model->contact === "" ? $supplier['contact'] : $model->contact) ?>">
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
                            <textarea name="address" id="address" class="form-control" placeholder="Address"><?= htmlspecialchars($model->address === "" ? $supplier['address'] : $model->address) ?></textarea>
                        </div>
                        <div class="input-group">
                            <div class="text-danger small ms-1" id="error"></div>
                        </div>
                    </div>
                    <!-- </form> -->

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary update-btn" data-work="updateSupplier">Update</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('body').on('click', '.update-btn', function(e) {
                e.preventDefault();
                const work = $(this).data('work');
                const updateSupplierData = {
                    uid: $('#uid').val(),
                    firstname: $('#firstname').val(),
                    lastname: $('#lastname').val(),
                    email: $('#email').val(),
                    contact: $('#contact').val(),
                    address: $('#address').val(),
                };

                $.ajax({
                    url: '/adminSupplierpage',
                    type: 'POST',
                    data: {
                        work: work,
                        updateSupplierData: updateSupplierData
                    },
                    success: function(response) {
                        // console.log(response);
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

                        if (response.html) {
                            const html = response.html;
                            $('.supplier-detail-card').replaceWith(html);
                            $('#supplierEditModal').modal('hide');
                        }

                        if (response.errors) {
                            const error = response.errors;
                            console.log(error);
                            Object.entries(error).forEach(attr => {
                                const fild = attr[0];
                                const error_value = attr[1][0];
                                const row = $('.' + fild);
                                const classupdate = row.find('#' + fild);
                                const errorshow = row.find('#error');
                                classupdate.addClass('is-invalid');
                                errorshow.replaceWith(`<div class="text-danger small ms-1" id="error">${error_value}</div>`);
                            });
                        }
                    },
                    error: function(xhr) {
                        console.log('Error: ' + xhr.responseText);
                    }
                });
            });
        });
    </script>