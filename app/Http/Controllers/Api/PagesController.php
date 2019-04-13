<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\PageResource;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

class PagesController extends Controller
{
    /**
     * @return array
     */
    public function index()
    {
        return Page::get(['id', 'title', 'color', '_lft', '_rgt', 'parent_id'])->toTree();
    }

    /**
     * @param int $id
     * @return PageResource
     */
    public function show(int $id)
    {
        return new PageResource(Page::findOrFail($id));
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function sort(Request $request)
    {
        $this->validate($request, [
            'pages' => 'required|array',
        ]);

        Page::unguarded(function () use ($request) {
            Page::rebuildTree($request->pages);
        });

        return $this->index();
    }

    /**
     *
     */
    public function update(Request $request, int $id)
    {
        $page = Page::findOrFail($id);

        $data = $this->validate($request, [
            'title' => 'required|min:3',
            'color' => 'required',
            'parent_id' => ['nullable', Rule::exists('pages', 'id')],
            'slug' => ['nullable', 'min:3', Rule::unique('pages')->ignore($id)],
        ]);

        Arr::forget($data, 'parent_id');

        $page->update($data);

        if ($request->has('parent_id')) {
            Page::findOrFail($request->parent_id)->appendNode($page);
        }

        return new PageResource(
            $page->refresh()
        );
    }
}