<?php

namespace core;
use core\DbModel;

abstract class UserModel extends DbModel{
    abstract public static function getDisplayName():string;
}

?>