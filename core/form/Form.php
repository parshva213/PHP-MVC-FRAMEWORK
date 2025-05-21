<?php

namespace form;

use core\Model;

abstract class Form
{
    public static function begin($action, $method)
    {
        echo sprintf('<form action="%s" method="%s">', $action, $method);
        return new static(); // Use late static binding to allow instantiation of a concrete subclass
    }

    public static function end()
    {
        echo '</form>';
    }

    public function field(Model $model, $attribute)
    {
        // Replace Field with a concrete subclass like InputField
        return new InputField($model, $attribute); // ✅ CORRECT
    }
}