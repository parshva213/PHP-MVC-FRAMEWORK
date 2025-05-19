<?php

namespace form;

use core\Model;

abstract class Field
{
    public Model $model;
    public array $attribute;

    public function __construct(Model $model, array $attribute)
    {
        $this->model = $model;
        $this->attribute = $attribute;
    }

    abstract public function renderInput(): string;

    public function __toString(): string
    {
        return sprintf(
            '
            <div class="form-group">
                <label>%s</label>
                %s
                <div class="invalid-feedback">
                    %s
                </div>
            </div>
            ',
            $this->attribute['label'] ?? '', // Default to an empty string if 'label' is not set
            $this->renderInput(), // Render the input field (implemented by subclasses)
            $this->model->getFirstError($this->attribute['name'] ?? '') ?? '' // Default to an empty string if no error exists
        );
    }
}
?>