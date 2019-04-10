<?php

namespace Tests\Feature\Api\Quotes;

use App\Models\Quote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowQuoteTest extends TestCase
{
    use RefreshDatabase;

    function test_a_quote_can_be_loaded_by_id()
    {
        $quote = factory(Quote::class)->create();

        $this->getJson(route('api.quote.show', $quote))
            ->assertJson([
                'data' => [
                    'id' => $quote->id,
                    'title' => $quote->title,
                    'text' => $quote->text,
                    'image' => $quote->image_url,
                ]
            ]);
    }
}