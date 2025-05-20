<?php

namespace form;

class Choice extends Field
{
    public function fieldtodisplay(): string
    {
        // Implement the rendering logic for Choice fields
        return '<input type="text" name="' . ($this->attribute['name'] ?? '') . '" class="form-control">';
    }
}
?>