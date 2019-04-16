<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Pages\RebuildTreeRequest;
use App\Http\Requests\Pages\StoreRequest;
use App\Http\Requests\Pages\UpdateRequest;
use App\Http\Resources\PageResource;
use App\Models\Page;

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
        return new PageResource(
            Page::findOrFail($id)
        );
    }

    /**
     * @param RebuildTreeRequest $request
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function sort(RebuildTreeRequest $request)
    {
        $request->persist();

        return $this->index();
    }

    /**
     * @param StoreRequest $request
     * @return PageResource
     */
    public function store(StoreRequest $request)
    {
        return new PageResource(
            $request->persist()
        );
    }

    /**
     * @param UpdateRequest $request
     * @param int $id
     * @return PageResource
     */
    public function update(UpdateRequest $request, int $id)
    {
        $page = Page::findOrFail($id);

        $request->persist($page);

        return new PageResource(
            $page->refresh()
        );
    }

    /**
     * @param int $id
     * @return array
     * @throws \Exception
     */
    public function delete(int $id)
    {
        $page = Page::findOrFail($id);
        $page->delete();

        return ['status' => 'ok'];
    }
}