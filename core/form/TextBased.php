<?php

namespace form;

class TextBased extends Field
{
    public function fieldtodisplay(): string
    {
        $html = sprintf("<label for='%s'>%s</label><br>", $this->attribute['name'] ?? '', $this->attribute['label'] ?? '');
        $html = sprintf("<input type='%s' name='%s' class='form-control%s'>",$this->attribute['type'], $this->attribute['name'] ?? "", $this->model->hasError($this->attribute['name']) ? " is-invalid" : "");

        return $html;
    }
}
?>

