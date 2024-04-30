<?php

namespace Validation\Rules;

use Enums\SenderTypeEnum;
use Validation\Rules\BaseRule;

class SenderTypeRule implements BaseRule
{

    public static function handle($value, $attribute): bool
    {
        if (!in_array($value, array_column(SenderTypeEnum::cases(), 'value'))) {
            return false;
        }
        return true;
    }

    public static function message(string $attribute, string $value): string
    {
        return "The {$attribute} must be one of the following: " . implode(', ', array_column(SenderTypeEnum::cases(), 'value'));
    }
}