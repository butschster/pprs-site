<?php

namespace Tests\Unit\Models;

use App\Models\Quote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuoteTest extends TestCase
{
    use RefreshDatabase;

    function test_it_has_image_url()
    {
        $quote = factory(Quote::class)->create();

        $this->assertNotNull($quote->image_url);
    }
}