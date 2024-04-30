<?php

namespace Validation\Rules;

use Closure;
use Validation\Rules\BaseRule;

class NumericRule implements BaseRule
{

    public static function handle($value, $attribute): bool
    {
        if (!preg_match('/^\d+$/', $value)) {
            return false;
        }
        return true;
    }

    public static function message(string $attribute, string $value): string
    {
        return "The {$attribute} must be a number";
    }
}