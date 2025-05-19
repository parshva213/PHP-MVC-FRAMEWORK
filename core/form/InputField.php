<?php
namespace form;

use core\Model;

class InputField extends Field
{
    public function renderInput(): string
    {
        return sprintf(
            '<input type="%s" name="%s" value="%s" class="form-control%s">',
            $this->attribute['type'] ?? 'text',
            $this->attribute['name'] ?? '',
            $this->model->{$this->attribute['name']} ?? '',
            $this->model->hasError($this->attribute['name']) ? ' is-invalid' : ''
        );
    }
}
?>