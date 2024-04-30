<?php

namespace Services;
require_once 'Enums/SenderTypeEnum.php';

use Enums\SenderTypeEnum;

class OutputSrevice
{
    const DIR = 'output';
    const FILE_BASE = '_reccomendations.json';
    public function handleOutput(SenderTypeEnum $sender, array $data)
    {
        if ($sender == SenderTypeEnum::FILE) {

            file_put_contents(self::DIR.'/'.date('Yd-m-Y-H-i-s').self::FILE_BASE, json_encode($data, JSON_PRETTY_PRINT));

        } elseif ($sender == SenderTypeEnum::CONSOLE) {
            print_r($data);
        }
    }
}