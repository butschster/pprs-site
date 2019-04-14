<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Banners\StoreRequest;
use App\Http\Requests\Banners\UpdateRequest;
use App\Http\Resources\BannerResource;
use App\Models\Banner;

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