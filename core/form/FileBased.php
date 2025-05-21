<?php

namespace form;

class FileBased extends InputField
{
    public function fieldtodisplay(): string
    {
        $html = sprintf("<label for='%s'>%s</label><br>", $this->attribute['name'] ?? '', $this->attribute['label'] ?? '');
        $html = sprintf("<input type='%s' name='%s'%s value='%s' class='form-control%s'>", $this->attribute['type'], $this->attribute['name'] ?? '', isset($this->attribute['accept']) && is_array($this->attribute['accept']) ? " accept='" . implode(", ", $this->attribute['accept']) . "'" : '', htmlspecialchars($this->model->{$this->attribute['name']}) ?? '', $this->model->hasError($this->attribute['name']) ? ' is-invalid' : '');
        return $html;
    }
}
?>