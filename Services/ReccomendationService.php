<?php

namespace Services;

class ReccomendationService
{
    const BASE_URL = 'http://www.boredapi.com/api/activity';
    public function getReccomendations(array $data)
    {
        $query_string = http_build_query($data);
        $requestUri = sprintf(
            '%s?%s',
            self::BASE_URL,
            $query_string
        );
        return json_decode(file_get_contents($requestUri), true);
    }
}