<?php

require_once 'Enums/SenderTypeEnum.php';
require_once 'Enums/TourTypeEnum.php';
require_once 'Validation/InputValidator.php';
require_once 'Services/ReccomendationService.php';
require_once 'Services/InputService.php';
require_once 'Services/OutputSrevice.php';

use Enums\SenderTypeEnum;
use Enums\TourTypeEnum;
use Validation\InputValidator;

class App
{
    public function run()
    {
        $this->getReccomendations();
    }


    private function getReccomendations()
    {
        $data = (new \Services\InputService())->handleInput();
        $recommendations = (new \Services\ReccomendationService())->getReccomendations($data);
        (new \Services\OutputSrevice())->handleOutput(SenderTypeEnum::tryFrom($data['sender']), $recommendations);
    }

}