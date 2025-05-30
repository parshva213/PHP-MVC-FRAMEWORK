<?php

namespace cuser;

use core\Model;


abstract class UpdateUser extends Model
{
    abstract public function attributes(): array;
    abstract public static function primaryKey(): string;
}
