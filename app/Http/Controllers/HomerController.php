<?php

namespace App\Http\Controllers;

use App\Repositories\PageRepository;

class HomerController extends Controller
{
    /**
     * @param PageRepository $repository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(PageRepository $repository)
    {
        $pages = $repository->getMenu();

        return view('home', compact('pages'));
    }
}
