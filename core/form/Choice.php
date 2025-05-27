<?php

namespace form;

class Choice extends InputField
{
    public function fieldtodisplay(): string
    {
        $html = sprintf("<lable for=\"%s\">%s</lable>",$this->attribute['name'] ?? "",$this->attribute['label'] ?? "");
        $html .= "<div class='row'>";
        for($i = 0; $i < count($this->attribute['value']); $i++){
            $html .= "<div class='col'>";
                $html .= sprintf("<input type='%s' name='%s' value='%s' class='form-control%s'> %s",     $this->attribute['type'], $this->attribute['name'] ?? "", $this->attribute['value'][$i] ?? "", $this->model->hasError($this->attribute['name']) ? " is-invalid" : "", $this->attribute['display'][$i] ?? ucfirst($this->attribute['value'][$i]) ?? "");
            $html .= "</div>";
        }
        $html .= "</div>";
        return $html;
    }
}
?>