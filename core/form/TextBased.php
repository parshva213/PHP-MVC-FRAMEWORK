<?php

namespace form;

class TextBased extends Field
{
    public function fieldtodisplay(): string
    {
        // Implement the rendering logic for TextBased fields
        return '<input type="text" name="' . ($this->attribute['name'] ?? '') . '" class="form-control">';
    }
}
?>