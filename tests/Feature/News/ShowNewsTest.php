<?php

namespace Tests\Feature\News;

use App\Models\News;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowNewsTest extends TestCase
{
    use RefreshDatabase;

    function test_a_news_can_be_showed()
    {
        $news = factory(News::class)->create();

        $this->get($news->url())
            ->assertSee($news->title)
            ->assertSee($news->text)
            ->assertSee($news->formatted_date);
    }
}
