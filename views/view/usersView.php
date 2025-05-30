<?php

use core\Application;

$this->title = 'Users View Action';

const STATUS_INACTIVE = "0";
const STATUS_ACTIVE = "1";
const STATUS_DELETED = "2";

$db = Application::$app->db->pdo;

$users = $db->query("SELECT * FROM ausers")->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="container">
    <h1 class="mt-4">Users View</h1>
    <div class="table-responsive">
        <table class="table table-striped user-table">
            <thead>
                <tr>
                    <th>UID</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Contact</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user):
                    $role = ($user['user_type'] == "o") ? "Owner" : (($user['user_type'] == "c") ? "Customer" : (($user['user_type'] == "m") ? "Manufacturer" : (($user['user_type'] == "s") ? "Supplier" : ""))); ?>
                    <tr>
                        <td><?= htmlspecialchars($user['uid']) ?></td>
                        <td><?= htmlspecialchars($user['firstname'] . ' ' . $user['lastname']) ?></td>
                        <td><?= htmlspecialchars($role) ?></td>
                        <td><a href="https://mail.google.com/mail/u/0/#inbox?compose=<?= htmlspecialchars($user['email']) ?>" target="_blank"><i class="bi bi-envelope-at"></i></a>

                            <a href="tel:<?= htmlspecialchars($user['contact']) ?>"><i class='bi bi-telephone'></i></a>
                            <a href="https://www.google.com/maps/search/?api=1&query=<?= urlencode($user['address']) ?>" target="_blank"><i class="bi bi-map"></i></a>
                        </td>
                        <td class="dropdown">
                            <?php echo ($user['status'] === STATUS_ACTIVE) ? "<span class='badge bg-success'>Active</span>" : (($user['status'] === STATUS_INACTIVE) ? "<span class='badge bg-warning'>Inactive</span>" : "<span class='badge bg-danger'>Blocked</span>"); ?>
                            <a href="#" class="text-black" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots-vertical"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- Nested Dropdown Item -->
                                <?php if ($user['status'] != 1): ?>
                                    <li>
                                        <button type="button" class="dropdown-item text-success allow-btn edit-status" data-uid="<?= htmlspecialchars($user['uid']) ?>" data-activity="<?= STATUS_ACTIVE ?>">
                                            Active
                                        </button>
                                    </li>
                                <?php endif; ?>
                                <?php if ($user['status'] != 0): ?>
                                    <li>
                                        <button type="button" class="dropdown-item text-warning allow-btn edit-status" data-uid="<?= htmlspecialchars($user['uid']) ?>" data-activity="<?= STATUS_INACTIVE ?>">
                                            Block
                                        </button>
                                    </li>
                                <?php endif; ?>
                                <?php if ($user['status'] != 2): ?>
                                    <li>
                                        <button type="button" class="dropdown-item text-danger allow-btn edit-status" data-uid="<?= htmlspecialchars($user['uid']) ?>" data-activity="<?= STATUS_DELETED ?>">
                                            Permanently Blocked
                                        </button>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('body').on('click', '.edit-status', function(e) {
            e.preventDefault(); // stop default button action

            const uid = $(this).data('uid');
            const activity = $(this).data('activity');
            $.ajax({
                url: '/giveAccess', // update to correct PHP script
                type: 'GET',
                data: {
                    uid: uid,
                    active: activity
                },
                success: function(response) {

                    location.reload(); // optionally refresh page
                },
                error: function(xhr) {
                    alert('Error: ' + xhr.responseText);
                }
            });
        });
    });
</script>