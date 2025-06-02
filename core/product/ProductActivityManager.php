<?php

namespace cproduct;

use core\Application;
use core\Need;

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
    <span class="form-check form-switch">
        <input
            data-pid="' . htmlspecialchars($record['pid']) . '"
            data-state="' . $dataState . '"
            class="form-check-input status_check"
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
        $fetchData = $statement->fetchObject();
        header('Content-Type: application/json');
        echo json_encode([
            'fetchData' => $fetchData
        ]);
        exit;
    }
}
