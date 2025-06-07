<?php

namespace cuser;

use core\Application;
use muser\UppdateSupplier;
use PDO;

class UpdateSupplier extends UppdateSupplier
{
    public function updateSupplier(array $data)
    {
        $uid = $data['uid'];
        $this->firstname = $data['firstname'];
        $this->lastname = $data['lastname'];
        $this->email = $data['email'];
        $this->contact = $data['contact'];
        $this->address = $data['address'];
        $db = Application::$app->db->pdo;

        if ($this->validata($uid, $db)) {
            $tablename = $this->tableName();
            $attributes = $this->attributes();
            $params = array_map(function ($attr) {
                return $attr . ' = :' . $attr;
            }, $attributes);
            $stmt = $db->prepare("UPDATE $tablename SET " . implode(', ', $params) . " WHERE uid = :uid");
            foreach ($attributes as $attr) {
                $stmt->bindValue(":$attr", $this->{$attr});
            }
            $stmt->bindValue(':uid', $uid);
            if ($stmt->execute()) {
                $stmt = $db->prepare("SELECT * FROM $tablename WHERE uid = :uid");
                $stmt->bindValue(':uid', $uid);
                $stmt->execute();
                $supplier = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $supplier = $supplier[0]; // Get the first row

                $html = "
                <div class=\"card supplier-detail-card\">
    <div class=\"card-header text-center\">
        <p>" . htmlspecialchars($supplier['firstname']) . " " . htmlspecialchars($supplier['lastname']) . "</p>
    </div>
    <div class=\"card-body d-flex justify-content-evenly\">
        <p><strong>Email:</strong> " . htmlspecialchars($supplier['email']) . "</p>
        <p><strong>Contact:</strong> " . htmlspecialchars($supplier['contact']) . "</p>
        <p><strong>Address:</strong> " . htmlspecialchars($supplier['address']) . "</p>
    </div>
    <div class=\"card-footer text-center\">
        <button class=\"btn btn btn-outline-warning opacity-50\" data-bs-toggle=\"modal\" data-bs-target=\"#supplierEditModal\">Edit</button>
    </div>
</div>";
                header('Content-Type: application/json');
                echo json_encode([
                    'html' => $html,
                    'attributes' => $this->attributes(),
                ]);
                exit;
            } else {
                header('Content-Type: application/json');
                echo json_encode([
                    'updateSupplier' => false,
                    'message' => 'Failed to update supplier.'
                ]);
                exit;
            }
        }
    }
}
