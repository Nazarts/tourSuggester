<?php

namespace Validation\Rules;

class NullableRule
{

    public static function handle($value): bool
    {
        return ($value === null || $value === '');
    }
}