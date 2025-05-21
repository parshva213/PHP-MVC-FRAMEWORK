<?php

namespace form;

use core\Model;

abstract class Field extends Form
{
    public Model $model;
    public array $attribute = [];
    public array $type = [];

    public function __construct(Model $model, array $attribute)
    {
        $this->model = $model;
        $this->attribute = $attribute;
    }

    abstract public function setfile(): string;


    public function __toString(): string
    {
        return sprintf(
            '
            <div class="form-group">
                %s
                <div class="invalid-feedback">
                    %s
                </div>
            </div>
            ',
            $this->setfile(), // Render the input field (implemented by subclasses)
            $this->model->getFirstError($this->attribute['name'] ?? '') ?? '' // Default to an empty string if no error exists
        );
    }

    // public function fieldcheck($fild) : string 
    // {
    //     $array = [
    //         "TextBased" => ["text", "password", "email", "search", "tel", "url"],
    //         "MultilineText" => ["textarea"],
    //         "Numeric" => ["number", "range"],
    //         "DateAndTime" => ["date", "datetime-local", "month", "time", "week"],
    //         "FileBased" => ["file", "image"],
    //         "Choice" => ["checkbox", "radio"],
    //         "OptionalChoice" => ["select"],
    //         "Other" => ["submit", "reset", "button", "color", "hidden"]
    //     ];
    //     foreach($array as $k => $v1){
    //         if (in_array($fild, $v1)) {
    //             return $k;
    //         }
    //     }
    //     return '';
    // }
}

?>