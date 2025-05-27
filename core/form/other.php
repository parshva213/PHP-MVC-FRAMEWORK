<?php

namespace form;

class other extends InputField
{
    public function fieldtodisplay(): string
    {
        if ($this->attribute['type'] === 'color') {
            $html = sprintf("<label for='%s'>%s</label>", $this->attribute['name'] ?? '', $this->attribute['label'] ?? '');
        } else {
            $html = '';
        }

    $html .= sprintf("<input type='%s' name='%s'%s class='form-control%s'>", $this->attribute['type'], $this->attribute['name'] ?? '', isset($this->attribute['value']) ? " value='" . htmlspecialchars($this->attribute['value']) . "'" : '', $this->model->hasError($this->attribute['name']) ? ' is-invalid' : '');

        return $html;
    }
}
?>