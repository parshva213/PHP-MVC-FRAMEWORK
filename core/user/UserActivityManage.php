<?php


namespace cuser;

use core\Application;

class UserActivityManage
{
    public int $id;

    public function adminValidateSuccess($id)
    {
        $this->id = $id;
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['uid'])) {
            $uid = $_POST['uid'];
            $db = Application::$app->db->pdo;
            $stmt = $db->prepare("DELETE FROM causers WHERE uid = ?");
            if ($stmt->execute([$uid])) {
                return Application::$app->session->setFlash('success', "User with ID {$this->id} has been verified successfully.");
            } else {
                return Application::$app->session->setFlash('error', "Failed to verify user with ID {$this->id}.");
            }
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
