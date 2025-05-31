<?php

namespace cproduct;

use core\Application;

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
            // return $record;
            header('Content-Type: application/json');
            echo json_encode([
                'pid' => $pid,
                'record' => $record
            ]);
            exit;
        } else {
            // header('Content-Type: application/json', true, 500);
            // echo json_encode(['error' => 'Update failed']);
            exit;
        }
    }
}
