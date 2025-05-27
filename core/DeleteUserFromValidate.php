<?php


namespace core;

use controllers\SiteController;

class DeleteUserFromValidate extends SiteController
{
    public int $id;

    public function delete($id)
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
}
