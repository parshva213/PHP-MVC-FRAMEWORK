<?php

namespace form;

class Numeric extends Field
{
    public function fieldtodisplay(): string
    {
        // Implement the rendering logic for Numeric fields
        return '<input type="text" name="' . ($this->attribute['name'] ?? '') . '" class="form-control">';
    }
}
?>