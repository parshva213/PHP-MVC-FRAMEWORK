<?php

namespace form;

class MultilineText extends Field
{
    public function fieldtodisplay(): string
    {
        // Implement the rendering logic for MultilineText fields
        return '<input type="text" name="' . ($this->attribute['name'] ?? '') . '" class="form-control">';
    }
}
?>