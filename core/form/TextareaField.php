<?php

namespace form;

class TextareaField extends InputField
{
    protected array $attributes = [];
    
    public function renderInput(): string
    {
        // Use sprintf to generate the textarea element
        return sprintf(
            '<textarea name="%s" rows="%s" cols="%s" class="form-control%s">%s</textarea>',
            $this->attributes['name'] ?? '',
            $this->attributes['rows'] ?? 5, // Corrected 'rows' placeholder
            $this->attributes['cols'] ?? 50, // Corrected 'cols' placeholder
            $this->renderAttributes(),
            $this->attributes['value'] ?? '',
        );
    }

    private function renderAttributes(): string
    {
        $attributes = '';
        foreach ($this->attributes as $key => $value) {
            if ($key !== 'name' && $key !== 'value' && $key !== 'label' && $key !== 'error') {
                $attributes .= sprintf('%s="%s" ', $key, htmlspecialchars($value));
            }
        }
        return trim($attributes);
    }
}


?>