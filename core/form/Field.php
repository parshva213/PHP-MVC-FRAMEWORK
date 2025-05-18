<?php

namespace form;

use core\Model;

class Field{
    public Model $model;
    public array $attribute;

    public function __construct(Model $model, array $attribute)
    {
        $this->model = $model;
        $this->attribute = $attribute;
    }


    public function __toString()
    {
        return sprintf('
            <div class="form-group">
                <label>%s</label>
                <input type="%s" name="%s" value="%s" class="form-control%s">
                <div class="invalid-ffeedback">
                    %s
                </div>
            </div>
            ',
            $this->attribute['label'], 
            $this->attribute['type'],
            $this->attribute['name'],
            $this->model->{$this->attribute['name']},
            $this->model->hasError($this->attribute['name']) ? ' is-invalid' : '',
            $this->model->getFirstError($this->attribute['name'])
        );
    }

    
}

?>