<?php


use core\Application;
use core\Need;

$this->title = 'Product View Action';

$db = Application::$app->db->pdo;

$products = $db->query("SELECT * FROM product")->fetchAll(PDO::FETCH_ASSOC);
?>
<h1 class="mt-4">Product View</h1>
<div class="table-responsive">
    <table class="table table-striped user-table" style="min-height: 75vh; margin:0 0 2vh 0;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Type</th>
                <th>HSF No</th>
                <th>Description</th>
                <th>User ID </th>
                <th>User Role</th>
                <th>Status</th>
                <th>Quantity</th>
                <th>MRP</th>
                <th>Selling Price</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (count($products) > 0) {
                foreach ($products as $p) {
            ?>
                    <tr>
                        <td><?php echo $p['pid'] ?></td>
                        <td><?php echo $p['pname'] ?></td>
                        <td><?php echo $p['product_type'] ?></td>
                        <td><?php echo $p['hsfno'] ?></td>
                        <td><?php echo $p['description'] ?></td>
                        <td><?php echo $p['uploaded_by_uid'] ?></td>
                        <td><?php echo $p['user_type'] ?></td>
                        <td><?php echo $p['pstate'] ?></td>
                        <td><?php echo $p['quantity'] ?></td>
                        <td><?php echo $p['mrp'] ?></td>
                        <td><?php echo $p['selling_price'] ?></td>
                        <td><?php echo $p['created_at'] ?></td>
                        <td><?php echo $p['last_updated_at'] ?></td>
                        <td>
                            <a href="#" class="text-black" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots-vertical"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- Nested Dropdown Item -->
                                <li>
                                    <?php if ($p['productstate'] != Need::PRODUCT_STATE_ACTIVE): ?>
                                        <button type="button" class="dropdown-item text-success allow-btn edit-state" data-pid="<?= htmlspecialchars($p['pid']) ?>" data-state="<?= Need::PRODUCT_STATE_ACTIVE ?>">
                                            Active
                                        </button>
                                    <?php elseif ($p['productstate'] != Need::PRODUCT_STATE_INACTIVE): ?>
                                        <button type="button" class="dropdown-item text-danger allow-btn edit-state" data-pid="<?= htmlspecialchars($p['pid']) ?>" data-state="<?= Need::PRODUCT_STATE_INACTIVE ?>">
                                            In Active
                                        </button>
                                    <?php endif; ?>
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
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('body').on('click', '.edit-state', function(e) {
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

                    location.reload(); // optionally refresh page
                    console.log('success');
                },
                error: function(xhr) {
                    alert('Error: ' + xhr.responseText);
                }
            });
        });
    });
</script>