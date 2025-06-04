<?php

namespace cproduct;

use core\Application;
use core\Need;
use mproduct\AdminProductUpdate;
use PDO;

class ProductActivityManager
{
    public string $tablename = "product";
    public function adminProductState($pid, $pstate)
    {
        $db = Application::$app->db->pdo;
        $sql = "UPDATE $this->tablename SET pstate = :pstate where pid = :pid;";
        $statement = $db->prepare($sql);
        $statement->bindValue(':pstate', $pstate);
        $statement->bindValue(':pid', $pid);
        if ($statement->execute()) {
            $sql = "SELECT * from $this->tablename where pid = :pid;";
            $statement = $db->prepare($sql);
            $statement->bindValue(':pid', $pid);
            $statement->execute();
            $record = $statement->fetchAll();
            $record = $record[0];
            $isChecked = ($record['pstate'] == Need::PRODUCT_STATE_ACTIVE);
            $dataState = $isChecked ? Need::PRODUCT_STATE_INACTIVE : Need::PRODUCT_STATE_ACTIVE;
            $checkedAttr = $isChecked ? 'checked' : '';

            $html = '
<td class="product-state">
    <span>' . htmlspecialchars($record['pstate']) . '</span>
    <span class="form-check edit-field form-switch">
        <input
            data-pid="' . htmlspecialchars($record['pid']) . '"
            data-work="' . $dataState . '"
            class="form-check-input edit-field"
            type="checkbox"
            role="switch"
            ' . $checkedAttr . ' />

    </span>
</td>';

            header('Content-Type: application/json');
            echo json_encode([
                'pid' => $pid,
                'record' => $html
            ]);
            exit;
        } else {
            // header('Content-Type: application/json', true, 500);
            // echo json_encode(['error' => 'Update failed']);
            exit;
        }
    }

    public function adminProductFetchById($pid)
    {
        $db = Application::$app->db->pdo;
        $sql = "SELECT * FROM $this->tablename where pid = $pid";
        $statement = $db->prepare($sql);
        $statement->execute();
        $UpdateFetch = $statement->fetchObject();
        header('Content-Type: application/json');
        echo json_encode([
            'UpdateFetch' => $UpdateFetch
        ]);
        exit;
    }

    public function adminProductUpdateValidate(array $data)
    {
        $productUpdate = new AdminProductUpdate();
        $productUpdate->pid = $data['pid'];
        $productUpdate->pname = $data['pname'];
        $productUpdate->product_type = $data['product_type'];
        $productUpdate->hsfno = $data['hsfno'];
        $productUpdate->description = $data['description'];
        $productUpdate->pstatus = $data['pstatus'];
        $productUpdate->quantity = $data['quantity'];
        $productUpdate->mrp = $data['mrp'];
        $productUpdate->selling_price = $data['selling_price'];
        if ($productUpdate->validate()) {
            $db = Application::$app->db->pdo;
            $attribute = $productUpdate->attribute();
            $prams = array_map(fn($attr) => "$attr = :$attr", $attribute);
            $sql = "UPDATE $this->tablename set " . implode(',', $prams) . " where pid = $productUpdate->pid;";
            $statement = $db->prepare($sql);
            foreach ($attribute as $a) {
                $statement->bindValue(":$a", $productUpdate->{$a});
            }
            if ($statement->execute()) {
                $sql = "SELECT * FROM $this->tablename WHERE pid = $productUpdate->pid;";
                $statement = $db->prepare($sql);
                $statement->execute();
                $p = $statement->fetchAll(PDO::FETCH_ASSOC);
                $p = $p[0];
                $role = ($p['user_type'] == "a") ? "Admin" : (($p['user_type'] == "o") ? "Owner" : (($p['user_type'] == "c") ? "Customer" : (($p['user_type'] == "m") ? "Manufacturer" : (($p['user_type'] == "s") ? "Supplier" : ""))));

                $isChecked = ($p['pstate'] == Need::PRODUCT_STATE_ACTIVE);
                $checkedAttr = $isChecked ? 'checked' : '';
                $dataWork = $isChecked ? Need::PRODUCT_STATE_INACTIVE : Need::PRODUCT_STATE_ACTIVE;
                $pidEscaped = htmlspecialchars($p['pid']);

                $html = <<<HTML
<tr id="product-{$pidEscaped}">
    <td class="product-pid">{$p['pid']}</td>
    <td class="product-name">{$p['pname']}</td>
    <td class="product-type">{$p['product_type']}</td>
    <td class="product-hsfno">{$p['hsfno']}</td>
    <td class="product-description">{$p['description']}</td>
    <td class="product-uname">{$p['user_name']}</td>
    <td class="product-user-role">{$role}</td>
    <td class="product-status">{$p['pstatus']}</td>
    <td class="product-quantity">{$p['quantity']}</td>
    <td class="product-mrp">{$p['mrp']}</td>
    <td class="product-sp">{$p['selling_price']}</td>
    <td class="product-state">
        <span>{$p['pstate']}</span>
        <span class="form-check edit-field form-switch">
            <input
                data-pid="{$pidEscaped}"
                data-work="{$dataWork}"
                class="form-check-input edit-field"
                type="checkbox"
                role="switch"
                {$checkedAttr} />
        </span>
    </td>
    <td class="product-created">{$p['created_at']}</td>
    <td class="product-updated">{$p['last_updated_at']}</td>
    <td class="product-action dropdown">
        <a href="#" class="text-black" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-three-dots-vertical"></i>
        </a>
        <ul class="dropdown-menu action-list">
            <li>
                <button type="button" class="dropdown-item text-success edit-field"
                    data-work="UpdateFetch"
                    data-pid="{$pidEscaped}"
                    data-bs-toggle="modal"
                    data-bs-target="#staticBackdropedit">
                    Edit
                </button>
            </li>
        </ul>
    </td>
</tr>
HTML;

                header('Content-Type: application/json');
                echo json_encode([
                    'row' => $html,
                    'pid' => $productUpdate->pid,
                    'attribute' => $productUpdate->attribute()
                ]);
                exit;
            } else {
                $error = "Enable to update product";
                header('Content-Type: application/json');
                echo json_encode([
                    'update_error' => $error,
                    'attribute' => $productUpdate->attribute()
                ]);
                exit;
            }
        } else {
            $error = [];
            foreach ($productUpdate->errors as $err => $val) {
                $error = array_merge($error, [['ERRORKEY' => $err, 'ERRORVAL' => $val[0]]]);
            }
            header('Content-Type: application/json');
            echo json_encode([
                'error' => $error,
                'attribute' => $productUpdate->attribute()
            ]);
            exit;
        }
    }
}
