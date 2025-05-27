<?php

namespace form;

class MultilineText extends InputField
{
    public function fieldtodisplay(): string
    {
        $html = sprintf("<label for='%s'>%s</label><br>", $this->attribute['name'] ?? '', $this->attribute['label'] ?? '');
        $html .= sprintf("<textarea name='%s' rows='%s' cols='%s' class='form-control%s'>%s</textarea>", $this->attribute['name'] ?? '', $this->attribute['rows'] ?? '4', $this->attribute['cols'] ?? '50', $this->model->hasError($this->attribute['name']) ? ' is-invalid' : '', htmlspecialchars($this->model->{$this->attribute['name']} ?? ''));
        return $html;
    }
}
?>