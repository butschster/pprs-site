<?php

namespace App\Services\TextParser;

class QuoteParser
{
    /**
     * @param string|null $string
     * @return string
     */
    public function parse(?string $string): string
    {
        return preg_replace('/\[quote\|([0-9]+)\]/', '<quote :id="$1"></quote>', $string);
    }
}