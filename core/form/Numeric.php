<?php

namespace form;

class Numeric extends InputField
{
    public function fieldtodisplay(): string
    {
        $html = sprintf("<label for='%s'>%s</label><br>", $this->attribute['name'] ?? "", $this->attribute['label'] ?? "");
        $html .= sprintf("<input type='%s' name='%s'%s%s%s class='form-control%s'>", $this->attribute['type'], $this->attribute['name'] ?? '', isset($this->attribute['min']) ? " min='" . $this->attribute['min'] . "'" : '', isset($this->attribute['max']) ? " max='" . $this->attribute['max'] . "'" : '', (isset($this->attribute['value']) ? " value='" . $this->attribute['value'] . "'" : '') ?? htmlspecialchars($this->model->{$this->attribute['name']}) ?? '', $this->model->hasError($this->attribute['name']) ? ' is-invalid' : '');

        return $html;
    }
}
?>