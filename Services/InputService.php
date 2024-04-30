<?php

namespace Services;
require_once 'Enums/SenderTypeEnum.php';
require_once 'Enums/TourTypeEnum.php';
require_once 'Validation/InputValidator.php';

use Enums\SenderTypeEnum;
use Enums\TourTypeEnum;
use InvalidArgumentException;
use Validation\InputValidator;

class InputService
{
    public function handleInput()
    {
        $data = [];
        $validator = new InputValidator();
        $messages = $validator->inputMessages();

        foreach ($validator->fieldsGetter() as $field) {
            $is_valid = false;
            while (!$is_valid) {
                if (array_key_exists($field, $messages)) {
                    echo $messages[$field] . PHP_EOL;
                } else {
                    echo "Enter {$field}: " . PHP_EOL;
                }
                $value = trim(fgets(STDIN));
                try {
                    $validator->validate($field, $value);
                    $is_valid = true;
                } catch (InvalidArgumentException $e) {
                    echo $e->getMessage() . PHP_EOL;
                }
            }
            $data[$field] = $value;
        }
        return $data;
    }
}