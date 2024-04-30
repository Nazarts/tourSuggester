<?php

namespace Validation\Rules;
require_once 'Enums/TourTypeEnum.php';
require_once 'BaseRule.php';

use Enums\TourTypeEnum;
use Validation\Rules\BaseRule;

class TourTypeRule implements BaseRule
{

    public static function handle($value, $attribute): bool
    {
        if (!in_array($value, array_column(TourTypeEnum::cases(), 'value'))) {
            return false;
        }
        return true;
    }

    public static function message(string $attribute, string $value): string
    {
        return "The {$attribute} must be one of the following: " . implode(', ', array_column(TourTypeEnum::cases(), 'value'));
    }
}