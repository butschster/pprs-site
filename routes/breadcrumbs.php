<?php

Breadcrumbs::for('home', function ($trail) {
    $trail->push('Главная страница', route('home'));
});

Breadcrumbs::for('page', function ($trail, $page) {
    $parent = $page->ancestors->first();

    if (!$parent) {
        $trail->parent('home');
    } else {
        $trail->parent('page', $parent);
    }

    $trail->push($page->title, $page->url());
});

Breadcrumbs::for('news', function ($trail) {
    $trail->parent('home');
    $trail->push('Новости', route('news.index'));
});

Breadcrumbs::for('news.show', function ($trail, $news) {
    $trail->parent('news');
    $trail->push($news->title, $news->url());
});