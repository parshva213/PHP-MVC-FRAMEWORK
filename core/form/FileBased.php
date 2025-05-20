<?php

namespace form;

class FileBased extends Field
{
    public function fieldtodisplay(): string
    {
        // Implement the rendering logic for FileBased fields
        return '<input type="text" name="' . ($this->attribute['name'] ?? '') . '" class="form-control">';
    }
}
?>