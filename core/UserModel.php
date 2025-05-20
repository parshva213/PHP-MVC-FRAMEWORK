<?php

namespace core;
use core\DbModel;

abstract class UserModel extends DbModel{
    abstract public function getDisplayName():string;
}

?>