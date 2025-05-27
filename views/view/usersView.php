<?php

use core\Application;

$this->title = 'Users View Action';

$db = Application::$app->db->pdo;

$users = $db->query("SELECT * FROM ausers")->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="container">
    <h1 class="mt-4">Users View</h1>
    <div class="table-responsive" style="max-height: 900px; overflow-y: auto; max-width: auto; overflow-x: auto;">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>UID</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Contact</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user):
                    $role = ($user['user_type'] == "o") ? "Owner" : (($user['user_type'] == "c") ? "Customer" : (($user['user_type'] == "m") ? "Manufacturer" : (($user['user_type'] == "s") ? "Supplier" : ""))); ?>
                    <tr>
                        <td><?= htmlspecialchars($user['uid']) ?></td>
                        <td><?= htmlspecialchars($user['firstname'] . ' ' . $user['lastname']) ?></td>
                        <td><?= htmlspecialchars($role) ?></td>
                        <td><a href="https://mail.google.com/mail/u/0/#inbox?compose=<?= htmlspecialchars($user['email']) ?>"><i class="bi bi-envelope-at"></i></a>
                            <?php
                            $usercon = $db->query("SELECT * FROM usercon WHERE uid = " . $user['uid'])->fetchAll(PDO::FETCH_ASSOC);
                            if (count($usercon) == 1) {
                                echo "<a href='tel:" . htmlspecialchars($usercon[0]['contact']) . "'><i class='bi bi-telephone'></i></a>";
                            } else {
                            ?>
                                <?php
                                foreach ($usercon as $con) {
                                    echo "<a href='tel:" . htmlspecialchars($con['contact']) . "'><i class='bi bi-telephone'></i></a>";
                                }
                                ?>
                            <?php
                            }
                            ?>
                            <a href="https://www.google.com/maps/search/?api=1&query=<?= urlencode($user['address']) ?>" target="_blank"><i class="bi bi-map"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>