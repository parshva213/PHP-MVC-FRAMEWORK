<?php

use core\Application;
use core\Need;

$this->title = 'Supplier List';

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
<div class="d-flex mb-3 gap-5">
    <?php if (count($suppliers) > 0) {
        foreach ($suppliers as $s) { ?>
            <div class="card 18rem">
                <div class="card-header">
                    <h5 class="card-text"><?= htmlspecialchars($s['firstname'] . ' ' . $s['lastname']) ?></h5>
                </div>
                <div class="card-body">
                    <p class="card-text">Email: <?= htmlspecialchars($s['email']) ?></p>
                    <p class="card-text">Contact: <?= htmlspecialchars($s['contact']) ?></p>
                    <p class="card-text">Address: <?= htmlspecialchars($s['address']) ?></p>
                </div>
            </div>
    <?php }
    } ?>
</div>