<?php

namespace App\Http\Controllers;

use App\Http\Requests\Subscription\Subscribe;
use Butschster\Head\Facades\Meta;

class SubscribeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function form()
    {
        Meta::prependTitle('Подписка на рассылку')
            ->setDescription('Подпишитесь на информационную рассылку о ППРС');

        return view('subscribe.form');
    }

    /**
     * @param Subscribe $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function subscribe(Subscribe $request)
    {
        $request->persist();

        return redirect()
            ->route('subscribe.form')
            ->with('success', 'Спасибо за подписку!');
    }
}
