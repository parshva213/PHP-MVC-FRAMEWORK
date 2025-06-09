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
    <table class="table table-striped supplier-table">
        <tr class="table-header">
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Address</th>
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
                    <a href="/adminSupplierDetail?uid=<?= $supplier['uid'] ?>" class="btn btn-sm btn-secondary bi bi-box-arrow-up-right"></a>
                </td>
            </tr>
        <?php
        } ?>
    </table>
<?php
} else {
?>
    <div class="alert alert-info" role="alert">
        No suppliers found.
    </div>
<?php
}
?>