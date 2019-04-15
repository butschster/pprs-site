<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\QuoteCollection;
use App\Http\Resources\QuoteResource;
use App\Models\Quote;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class QuotesController extends Controller
{
    /**
     * @return QuoteCollection
     */
    public function index()
    {
        return new QuoteCollection(
            Quote::latest()->get()
        );
    }

    /**
     * @param Quote $quote
     * @return QuoteResource
     */
    public function show(Quote $quote)
    {
        return new QuoteResource($quote);
    }

    /**
     * @param Request $request
     * @return QuoteResource
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'title' => 'required|string',
            'text' => 'required|string',
            'image_uuid' => ['required', Rule::exists('images', 'uuid')],
        ]);

        return new QuoteResource(
            Quote::create($data)
        );
    }

    /**
     * @param Request $request
     * @param Quote $quote
     * @return QuoteResource
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Quote $quote)
    {
        $data = $this->validate($request, [
            'title' => 'required|string',
            'text' => 'required|string',
            'image_uuid' => ['nullable', Rule::exists('images', 'uuid')],
        ]);

        $quote->update(array_filter($data));

        return new QuoteResource($quote);
    }

    /**
     * @param Quote $quote
     * @return array
     * @throws \Exception
     */
    public function delete(Quote $quote)
    {
        $quote->delete();

        return ['status' => 'ok'];
    }
}
