<?php
namespace Validation;
require_once 'Enums/TourTypeEnum.php';
require_once 'Validation/Rules/TourTypeRule.php';
require_once 'Validation/Rules/SenderTypeRule.php';
require_once 'Validation/Rules/NumericRule.php';
require_once 'Validation/Rules/NullableRule.php';
require_once 'Validation/Rules/BaseRule.php';

use Enums\SenderTypeEnum;
use Enums\TourTypeEnum;
use InvalidArgumentException;
use Validation\Rules\BaseRule;
use Validation\Rules\NullableRule;
use Validation\Rules\NumericRule;
use Validation\Rules\SenderTypeRule;
use Validation\Rules\TourTypeRule;

class InputValidator
{
    private array $fields;

    public function __construct()
    {
        $this->fields = [
            'participants' => [NullableRule::class, NumericRule::class],
            'type' => [NullableRule::class, TourTypeRule::class],
            'sender' => [SenderTypeRule::class],
        ];
    }

    public function fieldsGetter(): array
    {
        return array_keys($this->fields);
    }

    public function inputMessages(): array
    {
        return [
          'participants' => 'Enter a number of participants',
          'sender' => 'Enter a type of sender('.implode("', ", array_column(SenderTypeEnum::cases(), 'value'))."): ",
          'type' => "Enter type of tour(".implode("', ", array_column(TourTypeEnum::cases(), 'value'))."): "
        ];
    }

    /**
     * Validate the given value against the specified rules for the field.
     *
     * @param string $fieldName The name of the field to validate.
     * @param mixed $value The value to validate.
     * @throws InvalidArgumentException If the validation fails.
     * @return void
     */
    public function validate(string $fieldName, mixed $value): void
    {
        if (in_array(NullableRule::class, $this->fields[$fieldName])) {
            if (NullableRule::handle($value)) {
                return;
            }
        }
        foreach ($this->fields[$fieldName] as $rule) {
            if (class_implements($rule, BaseRule::class)) {
                $result = $rule::handle($value, $fieldName);
                if (!$result) {
                    throw new InvalidArgumentException($rule::message($fieldName, $value));
                }
            }
        }
    }
}