<?php

namespace App\Http\View\Presenters;

use Hemp\Presenter\Presenter;
use Illuminate\Support\Collection;

class PagePresenter extends Presenter
{
    /**
     * @return Collection
     */
    public function getChildren(): Collection
    {
        return $this->model->descendants->present(static::class);
    }
}