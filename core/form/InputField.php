<?php

namespace form;

abstract class InputField extends Field
{
    abstract public function fieldtodisplay(): string;

    public function setfile():string{
        return $this->fieldtodisplay();
    }
}
?>