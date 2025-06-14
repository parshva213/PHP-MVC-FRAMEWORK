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
            $this->company_id = $result['company_id'];
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
            $check = $this->check($data);
            if ($check === "Rule is empty") {
                // print_r($this->attributes());
                header('Content-Type: application/json');
                echo json_encode([
                    'attribute' => $this->attributes(),
                    'noupdate' => "hide"
                ]);
            }
            if ($check === "Validate success") {
                if ($this->update()) {
                    $db = Application::$app->db->pdo;
                    $stmt = $db->prepare("SELECT * FROM scompany WHERE company_id = :company_id");
                    $stmt->bindValue(':company_id', $this->company_id);
                    $stmt->execute();
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    $stmt = $db->prepare("SELECT * FROM scompanybank WHERE company_id = :company_id");
                    $stmt->bindValue(':company_id', $this->company_id);
                    $stmt->execute();
                    $bank = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $company = array_merge($result, $bank[0]);
                    $html = "
                    <tr class=\"company-" . htmlspecialchars($company['company_id']) . "\">
                            <td>" . htmlspecialchars($company['company_id']) . "</td>
                            <td>" . htmlspecialchars($company['company_name']) . "</td>
                            <td>" . htmlspecialchars($company['company_address']) . "</td>
                            <td>" . htmlspecialchars($company['gst_no']) . "</td>
                                    <td>" . htmlspecialchars($company['acc_hol_name']) . "</td>
                                    <td>" . htmlspecialchars($company['acc_no']) . "</td>
                                    <td>" . htmlspecialchars($company['bank_ifsc']) . "</td>
                                    <td>" . htmlspecialchars($company['bank_name']) . "</td>
                                    <td>" . htmlspecialchars($company['bank_branch']) . "</td>
                            <td class=\"text-center dropdown\">
                                <button class=\"btn btn-outline-secondary dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
                                    Action
                                </button>
                                <ul class=\"dropdown-menu dropdown-menu-end\" aria-labelledby=\"dropdownMenuButton\">
                                    <li>
                                        <button type=\"button\" class=\"dropdown-item btn btn-secondary company-detail-fetch-btn\" data-bs-toggle=\"modal\" data-bs-target=\"#companyEditModal\" data-work=\"UpdateFetch\" data-company_id=" . htmlspecialchars($company['company_id']) . ">Edit Details</button>
                                    </li>

                                    <li>
                                        <button type=\"button\" class=\"dropdown-item btn btn-outline-secondary\">New Order</button>
                                    </li>
                                    <li>
                                        <button type=\"button\" class=\"dropdown-item btn btn-outline-secondary\">Order History</button>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    ";
                    header('Content-Type: application/json');
                    echo json_encode([
                        'attribute' => $this->attributes(),
                        'html' => $html,
                        'id' => $company['company_id'],
                        'noupdate' => "hide",
                    ]);
                } else
                    header('Content-Type: application/json');
                echo json_encode([
                    'attribute' => $this->attributes(),
                    'noupdate' => "hide"
                ]);
            }
            exit;
        }
    }
}
