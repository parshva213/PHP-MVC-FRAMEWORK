<?php

namespace core;

use core\Model;


abstract class UpdateUser extends Model
{
    abstract public static function tableNAME(): string;
    abstract public function attributes(): array;
    abstract public static function primaryKey(): string;
}
