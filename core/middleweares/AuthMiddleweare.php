<?php

namespace middleweares;

use core\Application;
use exception\ForbiddenException;
use middleweares\BaseMiddleweare;

class AuthMiddleweare extends BaseMiddleweare
{
    public array $actions = [];

    public function __construct(array $actions = [])
    {
        $this->actions = $actions;
    }

    public function execute(){
        if(!isset(Application::$app->user)){
            if(empty($this->actions || in_array(Application::$app->controller->action, $this->actions))){
                throw new ForbiddenException();
            }
        }      
    }
}

?>