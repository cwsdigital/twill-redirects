<?php

namespace CwsDigital\TwillRedirects\Twill\Capsules\Redirects\Events;

use Symfony\Component\HttpFoundation\Request;

class RedirectWasNotFound
{
    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
}
