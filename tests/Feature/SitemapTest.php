<?php

namespace Tests\Feature;

use App\Models\News;
use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PagesTableSeeder;
use Tests\TestCase;

class SitemapTest extends TestCase
{
    use RefreshDatabase;

    function test_it_can_be_generated()
    {
        (new PagesTableSeeder())->run(null);

        $pages = Page::get();

        $news = factory(News::class)->times(10)->create();

        $response = $this->get(route('sitemap'));

        foreach ($pages as $page) {
            $response->assertSee($page->url());
        }

        $response->assertSee(route('news.index'));
        $response->assertSee(route('home'));
        $response->assertSee(route('subscribe.form'));

        foreach ($news as $item) {
            $response->assertSee($item->url());
        }
    }
}