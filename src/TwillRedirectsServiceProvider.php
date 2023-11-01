<?php

namespace CwsDigital\TwillRedirects;

use A17\Twill\TwillPackageServiceProvider;

class TwillRedirectsServiceProvider extends TwillPackageServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/config/redirects.php' => config_path('redirects.php'),
        ], 'config');

        parent::boot();
    }

    protected function registerCapsule(string $name): void
    {
        $namespace = $this->getCapsuleNamespace();

        $namespace .= '\\Twill\\Capsules\\'.$name;

        $dir = $this->getPackageDirectory().DIRECTORY_SEPARATOR.
            'src'.DIRECTORY_SEPARATOR.
            'Twill'.DIRECTORY_SEPARATOR.
            'Capsules'.DIRECTORY_SEPARATOR.$name;

        \A17\Twill\Facades\TwillCapsules::registerPackageCapsule(
            $name,
            $namespace,
            $dir,
            $singular = null,
            $enabled = config('redirects.capsule.enabled', true),
            $automaticNavigation = config('redirects.capsule.automaticNavigation', true)
        );
    }
}
