<?php

namespace Tests\Unit\Http\View\Composers;

use App\Http\View\Composers\MenuComposer;
use App\Repositories\PageRepository;
use Illuminate\Support\Collection;
use Tests\TestCase;

class MenuComposerTest extends TestCase
{
    function test_compose()
    {
        $pages = new Collection();

        $this->mock(PageRepository::class, function ($mock) use($pages) {
            $mock->shouldReceive('getMenu')->once()->andReturn($pages);
        });

        $composer = $this->app[MenuComposer::class];

        $view = $this->mock(\Illuminate\View\View::class);
        $view->shouldReceive('with')
            ->with('pages', $pages);

        $composer->compose($view);
    }
}
