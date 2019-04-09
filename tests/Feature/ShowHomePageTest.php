<?php

namespace Tests\Feature;

use App\Models\Page;
use PagesTableSeeder;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowHomePageTest extends TestCase
{
    use RefreshDatabase;

    function test_it_can_be_showed()
    {
        (new PagesTableSeeder())->run(null);

        $response = $this->get('/')
            ->assertSee('Первично-прогрессирующий рассеянный склероз')
            ->assertSee('Информационный портал');

        Page::whereIsRoot()->with('children')->get()->each(function (Page $page) use ($response) {
            $response->assertSee($page->title)
                ->assertSee($page->url());

            foreach ($page->children as $child) {
                $response->assertSee($child->title)
                    ->assertSee($child->url());
            }
        });
    }

    function test_home_page_does_not_have_breadcrumbs()
    {
        $this->get('/')
            ->assertDontSee('Главная страница');
    }
}
