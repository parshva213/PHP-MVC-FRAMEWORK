<?php

namespace cproduct;

use core\Application;

class ProductActivityManager
{
    public string $tablename = "product";
    public function adminProductState($pid, $state)
    {
        $db = Application::$app->db->pdo;
        $sql = "UPDATE $this->tablename SET productstate = :productstate where pid = :pid;";
        $statement = $db->prepare($sql);
        $statement->bindValue(':productstate', $state);
        $statement->bindValue(':pid', $pid);
        if ($statement->execute([$state, $pid])) {
            return Application::$app->session->setFlash('success', "User with ID {$pid} has been verified successfully.");
        } else {
            return Application::$app->session->setFlash('error', "Failed to verify user with ID {$pid}.");
        }
    }
}
