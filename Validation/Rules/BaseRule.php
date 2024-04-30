<?php

namespace Validation\Rules;

use Closure;

interface BaseRule
{
    public static function handle($value, $attribute): bool;
    public static function message(string $attribute, string $value): string;
}