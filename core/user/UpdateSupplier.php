<?php

namespace cuser;

use core\Application;

class UppdateSupplier
{
    public function supplierDetailFetch($uid)
    {
        $db = Application::$app->db->pdo;
        $stmt = $db->prepare("SELECT * FROM ausers WHERE uid = :uid");
        $stmt->bindValue(':uid', $uid);
        if ($stmt->execute()) {
            $result = $stmt->fetchObject();
            // $result = $result[0];
            header('Content-Type: application/json');
            echo json_encode([
                'supplierDetailFetch' => $result
            ]);
            exit;
        }
    }
}
