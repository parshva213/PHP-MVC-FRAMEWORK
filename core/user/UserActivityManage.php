<?php


namespace cuser;

use core\Application;

class UserActivityManage
{
    public function adminValidateSuccess($id)
    {
        $db = Application::$app->db->pdo;
        $stmt = $db->prepare("DELETE FROM causers WHERE uid = ?");
        if ($stmt->execute([$id])) {
            return Application::$app->session->setFlash('success', "User with ID {$id} has been verified successfully.");
        } else {
            return Application::$app->session->setFlash('error', "Failed to verify user with ID {$id}.");
        }
    }

    public function adminLoginStatusManage($uid, $activity)
    {
        $db = Application::$app->db->pdo;
        $stmt = $db->prepare("UPDATE ausers SET status = ? WHERE uid = ?");
        if ($stmt->execute([$activity, $uid])) {
            return Application::$app->session->setFlash('success', "User with ID {$uid} has been updated successfully.");
        } else {
            return Application::$app->session->setFlash('error', "Failed to update user with ID {$uid}.");
        }
    }
}
