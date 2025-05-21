<?php

namespace form;

use PhpOption\Option;

class OptionalChoice extends InputField
{
    public function fieldtodisplay(): string
    {
        $html = sprintf("<label for='%s'>%s</label><br>", $this->attribute['name'] ?? '', $this->attribute['label'] ?? '');
        $html .= sprintf("<select name='%s' class='form-control%s'>", $this->attribute['name'], $this->model->hasError($this->attribute['name']) ? " is-invalid" : "");
        $html .= sprintf("<Option selected disabled>Select %s</Option>",ucfirst($this->attribute['lable']));
        for($i = 0; $i < count($this->attribute['value']); $i++){
            $html .= sprintf("<option value='%s'>%s</option>", $this->attribute['value'][$i], $this->attribute['display'][$i] ?? ucfirst($this->attribute['value'][$i]));
        }
        $html .= "</select>";
        return $html;
    }
}
?>