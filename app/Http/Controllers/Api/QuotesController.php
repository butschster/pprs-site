<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\QuoteResource;
use App\Models\Quote;
use App\Http\Controllers\Controller;

class QuotesController extends Controller
{
    /**
     * @param Quote $quote
     * @return QuoteResource
     */
    public function show(Quote $quote)
    {
        return new QuoteResource($quote);
    }
}
