<?php

namespace App\Services\Unisender;

use App\Services\Unisender\Contracts\Unisender as UnisenderContract;
use Illuminate\Support\Arr;
use Unisender\ApiWrapper\UnisenderApi;

class Unisender extends UnisenderApi implements UnisenderContract
{
    /**
     * @param string $name
     * @param array  $arguments
     *
     * @return string
     */
    public function __call($name, $arguments)
    {
        $result = parent::__call($name, $arguments);

        return Arr::get(json_decode($result, true), 'result');
    }
}