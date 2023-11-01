<?php

namespace CwsDigital\TwillRedirects\Twill\Capsules\Redirects\Repositories;

use A17\Twill\Repositories\ModuleRepository;
use CwsDigital\TwillRedirects\Twill\Capsules\Redirects\Models\Redirect;

class RedirectRepository extends ModuleRepository
{
    public function __construct(Redirect $model)
    {
        $this->model = $model;
    }
}
