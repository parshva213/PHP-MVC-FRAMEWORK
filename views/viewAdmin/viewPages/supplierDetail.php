<?php
// needed classess 
use core\Application;
use cuser\UpdateSupplier;
use cuser\UppdateCompanyDetails;
use mproduct\AddOrder;
// title
$this->title = 'Supplier Detail';
// check it is set or not to maintain page 
if (isset($_GET['uid'])) {
    $uid = $_GET['uid'];
    $this->title = 'Supplier Detail ' . $uid;
} else {
    echo '<div class="alert alert-info" role="alert">
        No suppliers found.
    </div>';
    exit;
}
// fetching supplier details 
$db = Application::$app->db->pdo;
$stmt = "SELECT * FROM ausers WHERE uid = :uid";
$stmt = $db->prepare($stmt);
$stmt->bindValue(':uid', $uid);
$stmt->execute();
?>
<!-- value for update supllier form -->
<div class="udpate-data">
    <?php
    $supplier = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>
</div>
<!-- if supplier not fachesthen exit -->
<?php
if (!$supplier) {
    echo '<div class="alert alert-info" role="alert">
        No supplier found.
    </div>';
    exit;
}
?>
<!-- supplier and company table details  -->
<div class="d-grid gap-5">
    <!-- supplier details  -->
    <div class="card supplier-detail-card">
        <div class="card-header text-center">
            <p class="fs-4">
                <strong>
                    <?php echo ucfirst(htmlspecialchars($supplier['firstname'] . ' ' . $supplier['lastname'])); ?>
                </strong>
            </p>
        </div>
        <div class="card-body d-flex flex-column">
            <div class="d-flex justify-content-evenly">
                <p class="text-center"><strong>Email:</strong><br><?php echo htmlspecialchars($supplier['email']); ?></p>
                <p class="text-center"><strong>Contact:</strong><br><?php echo htmlspecialchars($supplier['contact']); ?></p>
            </div>
            <div class="d-flex justify-content-evenly">
                <p class="text-center"><strong>Address:</strong><br><?php echo htmlspecialchars($supplier['address']); ?></p>
            </div>
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
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <button type="button" class="dropdown-item btn btn-secondary company-detail-fetch-btn" data-bs-toggle="modal" data-bs-target="#companyEditModal" data-work="UpdateFetch" data-company_id="<?= htmlspecialchars($company['company_id']) ?>">Edit Details</button>
                                    </li>
                                    <li>
                                        <button type="button" class="dropdown-item btn btn-outline-secondary add-order-model" data-bs-toggle="modal" data-bs-target="#newOrderPlace" data-company_id="<?= htmlspecialchars($company['company_id']) ?>">New Order</button>
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
        <?php
        }
        ?>
    </div>
</div>
<!-- Supplier Edit Modal -->
<div class="modal fade" id="supplierEditModal" tabindex="-1" aria-labelledby="supplierEditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Supplier</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body supplier-edit-modal-body">
                <?php $model = new UpdateSupplier(); ?>
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
                        <?php
                        $supplier['contact'] = str_replace(['+91', ' ', '-'], '', $supplier['contact'])
                        ?>
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
                <button type="button" class="btn btn-primary supplier-update-btn" data-work="updateSupplier">Update</button>
            </div>
        </div>
    </div>
</div>
<!-- Company Edit Modal -->
<div class="modal fade" id="companyEditModal" tabindex="-1" aria-labelledby="companyEditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Company</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php $model = new UppdateCompanyDetails(); ?>
                <input type="hidden" name="company_id" id="company_id" value="<?= htmlspecialchars($model->company_id) ?>">
                <div class="mb-3 company_name">
                    <div class="input-group">
                        <label for="name" class="fs-3">Name</label>
                    </div>
                    <div class="input-group">
                        <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Company Name" value="<?= htmlspecialchars($model->company_name) ?>">
                    </div>
                    <div class="input-group">
                        <div class="text-danger small ms-1" id="error"></div>
                    </div>
                </div>
                <div class="mb-3 company_address">
                    <div class="input-group">
                        <label for="company_address" class="fs-3">Address</label>
                    </div>
                    <div class="input-group">
                        <textarea class="form-control" id="company_address" name="company_address" placeholder="Company Address"><?= htmlspecialchars($model->company_address) ?></textarea>
                    </div>
                    <div class="input-group">
                        <div class="text-danger small ms-1" id="error"></div>
                    </div>
                </div>
                <div class="mb-3 gst_no">
                    <div class="input-group">
                        <label for="gst_no" class="fs-3">GST No</label>
                    </div>
                    <div class="input-group">
                        <input type="text" class="form-control" id="gst_no" name="gst_no" placeholder="GST No" value="<?= htmlspecialchars($model->gst_no) ?>">
                    </div>
                    <div class="input-group">
                        <div class="text-danger small ms-1" id="error"></div>
                    </div>
                </div>
                <div class="mb-3 acc_hol_name">
                    <div class="input-group">
                        <label for="acc_hol_name" class="fs-3">Account Holder Name</label>
                    </div>
                    <div class="input-group">
                        <input type="text" class="form-control" id="acc_hol_name" name="acc_hol_name" placeholder="Account Holder Name" value="<?= htmlspecialchars($model->acc_hol_name) ?>">
                    </div>
                    <div class="input-group">
                        <div class="text-danger small ms-1" id="error"></div>
                    </div>
                </div>
                <div class="acc_no mb-3">
                    <div class="input-group">
                        <label for="acc_no" class="fs-3">Account Number</label>
                    </div>
                    <div class="input-group">
                        <input type="text" class="form-control" id="acc_no" name="acc_no" placeholder="Account Number" value="<?= htmlspecialchars($model->acc_no) ?>">
                    </div>
                    <div class="input-group">
                        <div class="text-danger small ms-1" id="error"></div>
                    </div>
                </div>
                <div class="bank_ifsc mb-3">
                    <div class="input-group">
                        <label for="bank_ifsc" class="fs-3">IFSC</label>
                    </div>
                    <div class="input-group">
                        <input type="text" class="form-control" id="bank_ifsc" name="bank_ifsc" placeholder="IFSC" value="<?= htmlspecialchars($model->bank_ifsc) ?>">
                    </div>
                    <div class="input-group">
                        <div class="text-danger small ms-1" id="error"></div>
                    </div>
                </div>
                <div class="mb-3 bank_name">
                    <div class="input-group">
                        <label for="bank_name" class="fs-3">Bank Name</label>
                    </div>
                    <div class="input-group">
                        <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Bank Name" value="<?= htmlspecialchars($model->bank_name) ?>">
                    </div>
                    <div class="input-group">
                        <div class="text-danger small ms-1" id="error"></div>
                    </div>
                </div>
                <div class="mb-3 bank_branch">
                    <div class="input-group">
                        <label for="bank_branch" class="fs-3">Bank Branch</label>
                    </div>
                    <div class="input-group">
                        <input type="text" class="form-control" id="bank_branch" name="bank_branch" placeholder="Bank Branch" value="<?= htmlspecialchars($model->bank_branch) ?>">
                    </div>
                    <div class="input-group">
                        <div class="text-danger small ms-1" id="error"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary company-update-btn" data-work="UpdateCompany">Update</button>
            </div>
        </div>
    </div>
</div>
<!-- New Order Pace -->
<div class="modal fade" id="newOrderPlace" tabindex="-1" aria-labelledby="newOrderPlaceLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <?php $add = new AddOrder(); ?>
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Order</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- order Details -->
                <div class="new-order-place-to-next1">
                    <!-- company_id -->
                    <input type="hidden" name="company_id" id="company_id">
                    <!-- company_invoice_number -->
                    <div class="mb-3 company_invoice_number">
                        <div class="input-group">
                            <label for="company_invoice_number">In-voice Number</label>
                        </div>
                        <div class="input-group">
                            <input type="text" name="company_invoice_number" id="company_invoice_number" class="form-control" placeholder="Company In-voice Number" value="<?php htmlspecialchars($add->company_invoice_number) ?>">
                        </div>
                        <div class="input-group">
                            <div class="text-danger small ms-1" id="error"></div>
                        </div>
                    </div>
                    <!-- date_of_invoice -->
                    <div class="mb-3 date_of_invoice">
                        <div class="input-group">
                            <label for="date_of_invoice">Date of Invoice</label>
                        </div>
                        <div class="input-group">
                            <input type="date" name="date_of_invoice" id="date_of_invoice" class="form-control" placeholder="Date Of In-voice">
                        </div>
                        <div class="input-group">
                            <div class="text-danger small ms-1" id="error"></div>
                        </div>
                    </div>
                    <!-- due_date -->
                    <div class="mb-3 due_date">
                        <div class="input-group">
                            <label for="due_date">Due Date</label>
                        </div>
                        <div class="input-group">
                            <input type="date" name="due_date" id="due_date" class="form-control" placeholder="Date Of In-voice">
                        </div>
                        <div class="input-group">
                            <div class="text-danger small ms-1" id="error"></div>
                        </div>
                    </div>
                    <!-- e_way_bill_number -->
                    <div class="mb-3 e_way_bill_number">
                        <div class="input-group">
                            <label for="e_way_bill_number">E way bill number</label>
                        </div>
                        <div class="input-group">
                            <input type="text" name="e_way_bill_number" id="e_way_bill_number" class="form-control" placeholder="ewaybill number">
                        </div>
                        <div class="input-group">
                            <div class="text-danger small ms-1" id="error"></div>
                        </div>
                    </div>
                </div>
                <!-- Totail item Places -->
                <div class="d-none new-order-place-to-next2">
                    <!-- total_items -->
                    <div class="mb-3 total_items">
                        <div class="input-group">
                            <label for="total_items">Total Item</label>
                        </div>
                        <div class="input-group">
                            <input type="text" name="total_items" id="total_items" class="form-control" placeholder="Total Item">
                        </div>
                        <div class="input-group">
                            <div class="text-danger small ms-1" id="error"></div>
                        </div>
                    </div>
                    <!-- price_are_same -->
                    <div class="mb-3 price_are_same">
                        <div class="input-group">
                            <label for="price_are_same">All Price are <b>same</b></label>
                        </div>
                        <div class="input-group">
                            <span class="form-check edit-field form-switch">
                                <input
                                    class="form-check-input edit-field"
                                    type="checkbox"
                                    role="switch">
                            </span>
                        </div>
                        <div class="input-group">
                            <div class="text-danger small ms-1" id="error"></div>
                        </div>
                    </div>
                </div>
                <!-- item list with price  -->
                <div class="d-none new-order-place-to-next3">
                    <div class="mb-3 total_items">
                        <div class="input-group">
                            <label for="total_items">In-voice Number</label>
                        </div>
                        <div class="input-group">
                            <input type="text" name="total_items" id="total_items" class="form-control" placeholder="Company In-voice Number">
                        </div>
                        <div class="input-group">
                            <div class="text-danger small ms-1" id="error"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="model-footer d-flex flex-column">
                <!-- first page -->
                <div class="new-order-place-to-next1  ms-auto">
                    <button type="button" class="btn btn-primary check1" data-work="place_1">
                        Next
                        <span class="bi bi-arrow-right"></span>
                    </button>
                </div>
                <!-- second page -->
                <div class="new-order-place-to-next2 d-none d-flex justify-content-between">
                    <button type="button" class="btn btn-primary back" data-work="place1">
                        <span class="bi bi-arrow-left"></span>
                        Back
                    </button>
                    <button type="button" class="btn btn-primary check2" data-work="place_2">
                        Next
                        <span class="bi bi-arrow-right"></span>
                    </button>
                </div>
                <!-- third page -->
                <div class="new-order-place-to-next3 d-none d-flex justify-content-between">
                    <button type="button" class="btn btn-primary back" data-work="place2">
                        <span class="bi bi-arrow-left"></span>
                        Back
                    </button>
                    <button type="button" class="btn btn-primary check3" data-work="place_3">
                        Add
                        <span class="bi bi-plus"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- page Script -->
<script>
    $(document).ready(function() {
        // Supplier Edit Modal Script
        $('body').on('click', '.supplier-update-btn', function(e) {
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
                dataType: 'json',
                success: function(response) {
                    if (response.attributes) {
                        const attributes = response.attributes;
                        attributes.forEach(attr => {
                            const row = $('.' + attr);
                            const classupdate = row.find('#' + attr);
                            const errorshow = row.find('#error');
                            classupdate.removeClass('is-invalid');
                            errorshow.replaceWith(`<div class="text-danger small ms-1" id="error"></div>`);
                        });
                    }

                    if (response.model) {
                        $('.supplier-edit-modal-body').html(response.model);
                    }

                    if (response.html) {
                        $('.supplier-detail-card').replaceWith(response.html);
                        $('#supplierEditModal').modal('hide');
                    }

                    if (response.errors) {
                        const errors = response.errors;
                        Object.entries(errors).forEach(([field, errorMessages]) => {
                            const row = $('.' + field);
                            const classupdate = row.find('#' + field);
                            const errorshow = row.find('#error');
                            classupdate.addClass('is-invalid');
                            errorshow.html(errorMessages[0]);
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Status:', status);
                    console.log('Error:', error);
                    console.log('Full Response:', xhr.responseText);

                    // Try to find where the JSON actually starts
                    const responseText = xhr.responseText;
                    const jsonStart = responseText.indexOf('{');
                    if (jsonStart > 0) {
                        console.warn('Found non-JSON prefix:', responseText.substring(0, jsonStart));
                        try {
                            const json = JSON.parse(responseText.substring(jsonStart));
                            console.log('Extracted JSON:', json);
                            // You could theoretically process the JSON here if needed
                        } catch (e) {
                            console.error('Still could not parse extracted JSON', e);
                        }
                    }
                }
            });
        });
        // Company Edit Modal Script for Fatch
        $('body').on('click', '.company-detail-fetch-btn', function(e) {
            e.preventDefault();
            const work = $(this).data('work');
            const company_id = $(this).data('company_id');

            $.ajax({
                url: '/adminSupplierpage',
                type: 'GET',
                data: {
                    work: work,
                    company_id: company_id
                },
                success: function(response) {
                    // console.log(response);
                    if (response && response.company) {
                        const company = response.company;
                        $('#company_name').val(company.company_name);
                        $('#company_address').val(company.company_address);
                        $('#gst_no').val(company.gst_no);
                        $('#acc_hol_name').val(company.acc_hol_name);
                        $('#acc_no').val(company.acc_no);
                        $('#bank_ifsc').val(company.bank_ifsc);
                        $('#bank_name').val(company.bank_name);
                        $('#bank_branch').val(company.bank_branch);
                        $('#company_id').val(company.company_id);
                    }
                },
                error: function(xhr) {
                    console.log('Error: ' + xhr.responseText);
                }
            });
        });
        // Company Edit Modal Script for Update
        $('body').on('click', '.company-update-btn', function(e) {
            e.preventDefault();
            const work = $(this).data('work');

            // Define companyData as an object
            const companyData = {
                company_id: $('#company_id').val(),
                company_name: $('#company_name').val(),
                company_address: $('#company_address').val(),
                gst_no: $('#gst_no').val(),
                acc_hol_name: $('#acc_hol_name').val(),
                acc_no: $('#acc_no').val(),
                bank_ifsc: $('#bank_ifsc').val(),
                bank_name: $('#bank_name').val(),
                bank_branch: $('#bank_branch').val()
            };

            // Send companyData via AJAX
            $.ajax({
                url: '/adminSupplierpage',
                type: 'POST',
                data: {
                    work: work,
                    companyData: companyData
                },
                success: function(response) {
                    if (response.attribute) {
                        attribute = response.attribute;
                        Object.entries(attribute).forEach(attr => {
                            const field = attr[1];
                            const row = $('.' + field);
                            const classupdate = row.find('#' + field);
                            const errorshow = row.find('#error');
                            classupdate.removeClass('is-invalid')
                            errorshow.replaceWith(`<div class = "text-danger small ms-1" id = "error"></div>`);
                        });
                    }

                    if (response.noupdate) {
                        // console.log(response.noupdate);
                        $('#companyEditModal').css('display', 'none'); // ✅
                        $('#companyEditModal').removeClass('show'); // ✅
                        $('body').removeClass('modal-open'); // ✅
                        $('.modal-backdrop').remove(); // ✅
                    }

                    if (response.html) {
                        const html = response.html;
                        $('.company-' + response.id).replaceWith(html)
                    }

                    if (response.errors) {
                        const error = response.errors;
                        Object.entries(error).forEach(attr => {
                            const field = attr[0];
                            const error_value = attr[1][0];
                            const row = $('.' + field);
                            const classupdate = row.find('#' + field);
                            const errorshow = row.find('#error');
                            classupdate.addClass('is-invalid');
                            errorshow.replaceWith(`<div class="text-danger small ms-1" id="error">${error_value}</div>`);
                        });
                    }
                },
                error: function(xhr) {
                    fetch(window.location.href)
                        .then(response => {
                            console.log("HTTP Status Code:", response.status);
                        })
                        .catch(error => {
                            console.error("Fetch failed:", error);
                        });
                    console.log('Error: ' + xhr.responseText);
                }
            });
        });
        //cleare new order data form 
        $('body').on('click', '.add-order-model', function(e) {
            e.preventDefault();

            const cid = $(this).data('company_id');
            $('#company_id').val(cid);

            const fields = [
                'company_invoice_number',
                'date_of_invoice',
                'due_date',
                'e_way_bill_number',
                'total_items',
                'price_are_same'
            ];

            fields.forEach(id => {
                $('#' + id).val('');
            });
            // alert(1);
            $('.new-order-place-to-next1').removeClass('d-none');
            $('.new-order-place-to-next2, #new-order-place-to-next3').addClass('d-none');

            const attributes = [
                'company_invoice_number',
                'date_of_invoice',
                'e_way_bill_number',
                'due_date',
                'total_items'
            ];

            attributes.forEach(field => {
                const row = $('.' + field);
                const input = row.find('#' + field);
                const error = row.find('.error-msg'); // use class, not id
                input.removeClass('is-invalid');
                error.html('');
            });
        });

        // New order page 1 check
        $('body').on('click', '.check1', function(e) {
            e.preventDefault();
            const orderData = {
                company_id: $('#company_id').val(),
                company_invoice_number: $('#company_invoice_number').val(),
                date_of_invoice: $('#date_of_invoice').val(),
                due_date: $('#due_date').val(),
                e_way_bill_number: $('#e_way_bill_number').val()
            };
            const work = $(this).data('work');
            $.ajax({
                url: '/adminSupplierpage',
                type: 'POST',
                data: {
                    work: work,
                    orderData: orderData
                },
                success: function(response) {
                    console.log(response);
                    if (response.attribute) {
                        attribute = response.attribute;
                        Object.entries(attribute).forEach(attr => {
                            const field = attr[1];
                            const row = $('.' + field);
                            const classupdate = row.find('#' + field);
                            const errorshow = row.find('#error');
                            classupdate.removeClass('is-invalid')
                            errorshow.replaceWith(`<div class = "text-danger small ms-1" id = "error"></div>`);
                        });
                    }
                    if (response.errors) {
                        const error = response.errors;
                        Object.entries(error).forEach(attr => {
                            const field = attr[0];
                            const error_value = attr[1][0];
                            const row = $('.' + field);
                            const classupdate = row.find('#' + field);
                            const errorshow = row.find('#error');
                            classupdate.addClass('is-invalid');
                            errorshow.replaceWith(`<div class="text-danger small ms-1" id="error">${error_value}</div>`);
                        });
                    }

                    if (response.next) {
                        const next = response.next;
                        // console.log(1);

                        next.forEach(id => {
                            const element = $('.' + id);
                            // console.log(element);
                            if (element.hasClass('d-none')) {
                                element.removeClass('d-none');
                            } else {
                                element.addClass('d-none');
                            }
                            // console.log(element);
                        });

                    }
                },
                error: function(xhr) {
                    fetch(window.location.href)
                        .then(response => {
                            console.log("HTTP Status Code:", response.status);
                        })
                        .catch(error => {
                            console.error("Fetch failed:", error);
                        });
                    console.log('Error: ' + xhr.responseText);
                }
            });
        });
        $('body').on('click', '.back', function(e) {
            e.preventDefault();
            const work = $(this).data('work');
            $.ajax({
                url: '/adminSupplierpage',
                type: 'POST',
                data: {
                    work: work
                },
                success: function(response) {
                    if (response.back) {
                        const back = response.back;
                        back.forEach(id => {
                            const element = $('.' + id);
                            if (element.hasClass('d-none')) {
                                element.removeClass('d-none');
                            } else {
                                element.addClass('d-none');
                            }
                        })
                    }
                },
                error: function(xhr) {
                    fetch(window.location.href)
                        .then(response => {
                            console.log("HTTP Status Code:", response.status);
                        })
                        .catch(error => {
                            console.error("Fetch failed:", error);
                        });
                    console.log('Error: ' + xhr.responseText);
                }
            });
        });
        $('body').on('click', '.check2', function(e) {
            e.preventDefault();


        });
    });
</script>