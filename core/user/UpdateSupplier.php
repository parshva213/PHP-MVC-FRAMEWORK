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
    <div class=\"card-footer text-end\">
        <button class=\"btn btn-outline-warning\" data-bs-toggle=\"modal\" data-bs-target=\"#supplierEditModal\">Edit</button>
    </div>
</div>";
                $model = new UpdateSupplier(); // Proper instantiation of the model
                $modelhtml = "
<div class=\"modal-body supplier-edit-modal-body\">
    <input
        type=\"hidden\"
        placeholder=\"User ID\"
        name=\"uid\"
        id=\"uid\"
        value=\"" . htmlspecialchars($supplier['uid']) . "\" />
    <div class=\"mb-3 firstname lastname\">
        <div class=\"input-group\">
            <label for=\"name\" class=\"fs-3\">Name</label>
        </div>
        <div class=\"input-group\">
            <div class=\"input-group-text\"><span class=\"bi bi-person\"></span></div>
            <input type=\"text\" class=\"form-control\" id=\"firstname\" name=\"firstname\" placeholder=\"First Name\" value=\"" . htmlspecialchars($model->firstname === "" ? $supplier['firstname'] : $model->firstname) . "\">
            <input type=\"text\" name=\"lastname\" id=\"lastname\" class=\"form-control\" placeholder=\"Last Name\" value=\"" . htmlspecialchars($model->lastname === "" ? $supplier['lastname'] : $model->lastname) . "\">
        </div>
        <div class=\"input-group\">
            <div class=\"text-danger small ms-1\" id=\"error\"></div>
    </div>
    </div>
    <div class=\"mb-3 email\">
        <div class=\"input-group\">
            <label for=\"email\" class=\"fs-3\">Email</label>
        </div>
        <div class=\"input-group\">
            <div class=\"input-group-text\"><span class=\"bi bi-envelope\"></span></div>
            <input type=\"email\" class=\"form-control\" id=\"email\" name=\"email\" placeholder=\"Email\" value=\"" . htmlspecialchars($model->email === "" ? $supplier['email'] : $model->email) . "\">
        </div>
        <div class=\"input-group\">
            <div class=\"text-danger small ms-1\" id=\"error\"></div>
        </div>
    </div>
    <div class=\"mb-3 contact\">
        <div class=\"input-group\">
            <label for=\"contact\" class=\"fs-3\">Phone Number</label>
        </div>
        <div class=\"input-group\">
            <div class=\"input-group-text\"><span class=\"bi bi-phone\"></span></div>
            <input type=\"text\" class=\"form-control\" id=\"contact\" name=\"contact\" placeholder=\"Phone Number\" value=\"" . htmlspecialchars($model->contact === "" ? $supplier['contact'] : $model->contact) . "\">
        </div>
        <div class=\"input-group\">
            <div class=\"text-danger small ms-1\" id=\"error\"></div>
        </div>
    </div>
    <div class=\"mb-3 address\">
        <div class=\"input-group\">
            <label for=\"address\" class=\"fs-3\">Address</label>
        </div>
        <div class=\"input-group\">
            <div class=\"input-group-text\"><span class=\"bi bi-house\"></span></div>
            <textarea name=\"address\" id=\"address\" class=\"form-control\" placeholder=\"Address\">" . htmlspecialchars($model->address === "" ? $supplier['address'] : $model->address) . "</textarea>
        </div>
        <div class=\"input-group\">
            <div class=\"text-danger small ms-1\" id=\"error\"></div>
        </div>
    </div>
</div>";
                header('Content-Type: application/json');
                echo json_encode([
                    'html' => $html,
                    'model' => $modelhtml,
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
