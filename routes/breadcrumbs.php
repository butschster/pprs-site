<?php

use App\Models\Page;

Breadcrumbs::for('home', function ($trail) {
    $trail->push('Главная страница', route('home'));
});

Breadcrumbs::for('page', function ($trail, Page $page) {
    if ($page->ancestors->count() === 0) {
        $trail->parent('home');
    }

    foreach ($page->ancestors as $parent) {
        $trail->parent('page', $parent);
    }

    $trail->push($page->title, $page->url());
});