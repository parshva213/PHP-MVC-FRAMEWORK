<?php

namespace cuser;

use core\Application;
use muser\UpdateCompanyDetails;
use PDO;

class UppdateCompanyDetails extends UpdateCompanyDetails
{
    public function fetchcompany(int $company_id, int $isAjax = 0)
    {
        $this->company_id = $company_id;
        $db = Application::$app->db->pdo;
        $stmt = $db->prepare("SELECT * FROM scompany WHERE company_id = :company_id");
        $stmt->bindValue(':company_id', $this->company_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt = $db->prepare("SELECT * FROM scompanybank WHERE company_id = :company_id");
        $stmt->bindValue(':company_id', $this->company_id);
        $stmt->execute();
        $bank = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = array_merge($result, $bank[0]);
        if ($isAjax == 0) {
            header('Content-Type: application/json');
            echo json_encode([
                'company' => $result
            ]);
            exit;
        } else {
            $this->company_name = $result['company_name'];
            $this->company_address = $result['company_address'];
            $this->gst_no = $result['gst_no'];
            $this->acc_hol_name = $result['acc_hol_name'];
            $this->acc_no = $result['acc_no'];
            $this->bank_ifsc = $result['bank_ifsc'];
            $this->bank_name = $result['bank_name'];
            $this->bank_branch = $result['bank_branch'];
            return true;
        }
    }

    public function UpdateCompany(array $data)
    {
        if ($this->fetchcompany($data['company_id'], 1)) {
        }
    }
}
