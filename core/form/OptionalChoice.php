<?php

namespace form;

class OptionalChoice extends Field
{
    public function fieldtodisplay(): string
    {
        // Implement the rendering logic for OptionalChoice fields
        return '<input type="text" name="' . ($this->attribute['name'] ?? '') . '" class="form-control">';
    }
}
?>