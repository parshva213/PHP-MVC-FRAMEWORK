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
            ?>
                    <tr id="product-<?= htmlspecialchars($p['pid']) ?>">
                        <td class="product-pid"><?php echo $p['pid'] ?></td>
                        <td class="product-name"><?php echo $p['pname'] ?></td>
                        <td class="product-type"><?php echo $p['product_type'] ?></td>
                        <td class="product-hsfno"><?php echo $p['hsfno'] ?></td>
                        <td class="product-description"><?php echo $p['description'] ?></td>
                        <td class="product-uid"><?php echo $p['uploaded_by_uid'] ?></td>
                        <td class="product-user-role"><?php echo $p['user_type'] ?></td>
                        <td class="product-status"><?php echo $p['pstatus'] ?></td>
                        <td class="product-quantity"><?php echo $p['quantity'] ?></td>
                        <td class="product-mrp"><?php echo $p['mrp'] ?></td>
                        <td class="product-sp"><?php echo $p['selling_price'] ?></td>
                        <td class="product-state"><?php echo $p['pstate'] ?></td>
                        <td class="product-created"><?php echo $p['created_at'] ?></td>
                        <td class="product-updated"><?php echo $p['last_updated_at'] ?></td>
                        <td class="product-action dropdown">
                            <a href="#" class="text-black" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots-vertical"></i>
                            </a>
                            <ul class="dropdown-menu action-list">
                                <!-- Nested Dropdown Item -->
                                <li>
                                    <button type="button" class="dropdown-item text-success allow-btn edit-state" data-pid="<?= htmlspecialchars($p['pid']) ?>" data-state="<?= (($p['pstate'] != Need::PRODUCT_STATE_ACTIVE) ? Need::PRODUCT_STATE_ACTIVE : Need::PRODUCT_STATE_INACTIVE) ?>">
                                        State
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
                    const pid = response.pid;
                    $('#product-' + pid).find('.product-state').html(response.record);
                    console.log(response);
                },
                error: function(xhr) {
                    alert('Error: ' + xhr.responseText);
                }
            });
        });
    });
</script>