<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\NewsCollection;
use App\Http\Resources\NewsResource;
use App\Models\News;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * @return NewsCollection
     */
    public function index()
    {
        return new NewsCollection(
            News::latest()->paginate(10)
        );
    }

    /**
     * @param News $post
     * @return NewsResource
     */
    public function show(News $post)
    {
        return new NewsResource($post);
    }

    /**
     * @param Request $request
     * @return NewsResource
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'title' => 'required|string',
            'description' => 'required|string',
            'text' => 'required|string',
            'meta_title' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);

        return new NewsResource(
            News::create($data)
        );
    }

    /**
     * @param Request $request
     * @param News $post
     * @return NewsResource
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, News $post)
    {
        $data = $this->validate($request, [
            'title' => 'required|string',
            'description' => 'required|string',
            'text' => 'required|string',
            'meta_title' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);

        $post->update($data);

        return new NewsResource($post);
    }

    /**
     * @param News $post
     * @return array
     * @throws \Exception
     */
    public function delete(News $post)
    {
        $post->delete();

        return ['status' => 'ok'];
    }
}
