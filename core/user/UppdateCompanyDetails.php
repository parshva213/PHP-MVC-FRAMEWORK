<?php

namespace cuser;

use core\Application;
use muser\UpdateCompanyDetails;
use PDO;

class UppdateCompanyDetails extends UpdateCompanyDetails
{
    public function fetchcompany(int $company_id, int $isAjax = 0)
    {
        echo "In fetchcompany" . http_response_code();
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
            echo " else in fetchcompany" . http_response_code();
            $this->company_id = $result['company_id'];
            $this->company_name = $result['company_name'];
            $this->company_address = $result['company_address'];
            $this->gst_no = $result['gst_no'];
            $this->acc_hol_name = $result['acc_hol_name'];
            $this->acc_no = $result['acc_no'];
            $this->bank_ifsc = $result['bank_ifsc'];
            $this->bank_name = $result['bank_name'];
            $this->bank_branch = $result['bank_branch'];
            echo " else out fetchcompany" . http_response_code();
            return true;
        }
    }

    public function UpdateCompany(array $data)
    {
        echo "IN updatecompany" . http_response_code();
        if ($this->fetchcompany($data['company_id'], 1)) {
            echo "fetchcompany success" . http_response_code();
            if ($this->check($data) === "Rule is empty") {
                echo "check success => Rule is empty" . http_response_code();
                header('Content-Type: application/json');
                echo json_encode([
                    'attribute' => $this->attributes(),
                    'noupdate' => "hide"
                ]);
            }
            if ($this->check($data) === "Validate success") {
                echo "validate";
                exit;
                if ($this->update()) {
                    echo "1";
                    exit;
                }
            }
        }
    }
}
