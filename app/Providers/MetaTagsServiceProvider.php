<?php

namespace App\Providers;

use Butschster\Head\Contracts\Packages\PackageInterface;
use Butschster\Head\Facades\PackageManager;
use Butschster\Head\MetaTags\Entities\Favicon;
use Butschster\Head\MetaTags\Meta;
use Butschster\Head\Contracts\MetaTags\MetaInterface;
use Butschster\Head\Contracts\Packages\ManagerInterface;
use Butschster\Head\Providers\MetaTagsApplicationServiceProvider as ServiceProvider;

class MetaTagsServiceProvider extends ServiceProvider
{
    protected function packages()
    {
        PackageManager::create('favicons', function($package) {
            $sizes = ['16x16', '32x32'];

            foreach ($sizes as $size) {
                $package->addTag(
                    'favicon.'.$size,
                    new Favicon('/images/favicon/favicon-'.$size.'.png', [
                        'sizes' => $size
                    ])
                );
            }

            $package->addTag(
                'favicon.apple',
                new Favicon('/images/favicon/apple-touch-icon.png', [
                    'sizes' => '180x180'
                ])
            );
        });
    }

    public function register()
    {
        $this->registerPackageManager();
        $this->registerMeta();
        $this->packages();
    }
}