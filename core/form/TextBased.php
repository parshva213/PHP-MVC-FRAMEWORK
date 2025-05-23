<?php

namespace form;

class TextBased extends InputField
{
    public function fieldtodisplay(): string
    {
        $html = sprintf("<label for='%s'>%s</label><br>", $this->attribute['name'] ?? '', $this->attribute['label'] ?? '');
        $html .= sprintf("<input type='%s' name='%s' value='%s' class='form-control%s'>",$this->attribute['type'], $this->attribute['name'] ?? "", htmlspecialchars($this->model->{$this->attribute['name']}) ?? '', $this->model->hasError($this->attribute['name']) ? " is-invalid" : "");

        return $html;
    }
}
?>