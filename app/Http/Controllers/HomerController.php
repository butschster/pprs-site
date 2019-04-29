<?php

namespace App\Http\Controllers;

use Butschster\Head\Facades\Meta;
use App\Repositories\PageRepository;

class HomerController extends Controller
{
    /**
     * @param PageRepository $repository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(PageRepository $repository)
    {
        Meta::prependTitle('Первично-прогрессирующий рассеянный склероз')
            ->setDescription('Информационный портал о первично прогрессирующем рассеянном склерозе для пациентов и их родственников');

        $pages = $repository->getMenu();

        return view('home', compact('pages'));
    }
}
