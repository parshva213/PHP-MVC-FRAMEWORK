<?php

namespace form;

class DateAndTime extends Field
{
    public function fieldtodisplay(): string
    {
        // Implement the rendering logic for DateAndTime fields
        return '<input type="text" name="' . ($this->attribute['name'] ?? '') . '" class="form-control">';
    }
}
?>