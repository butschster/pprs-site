<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Banners\StoreRequest;
use App\Http\Requests\Banners\UpdateRequest;
use App\Http\Resources\BannerResource;
use App\Models\Banner;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BannersController extends Controller
{
    /**
     * @param Banner $banner
     * @return BannerResource
     */
    public function show(Banner $banner)
    {
        return new BannerResource($banner);
    }

    /**
     * @param StoreRequest $request
     * @return BannerResource
     */
    public function store(StoreRequest $request)
    {
        return $this->show(
            $request->persist()
        );
    }

    /**
     * @param UpdateRequest $request
     * @param Banner $banner
     * @return BannerResource
     */
    public function update(UpdateRequest $request, Banner $banner)
    {
        $request->persist($banner);

        return $this->show(
            $banner->refresh()
        );
    }

    /**
     * @param Request $request
     * @param Banner $banner
     * @throws \Illuminate\Validation\ValidationException
     */
    public function attach(Request $request, Banner $banner)
    {
        $this->validate($request, [
            'page_id' => ['required', Rule::exists('pages', 'id')]
        ]);

        Page::findOrFail($request->page_id)->update([
            'banner_id' => $banner->id
        ]);
    }

    /**
     * @param Banner $banner
     * @return array
     * @throws \Exception
     */
    public function delete(Banner $banner)
    {
        $banner->delete();

        return ['status' => 'ok'];
    }
}