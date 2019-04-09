<?php

namespace Tests\Unit\Models;

use App\Models\News;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NewsTest extends TestCase
{
    use RefreshDatabase;

    function test_it_has_url()
    {
        $news = factory(News::class)->create();

        $this->assertEquals(route('news.show', $news), $news->url());
    }
}
