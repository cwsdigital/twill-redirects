<?php

namespace CwsDigital\TwillRedirects\Twill\Capsules\Redirects\Events;

class RedirectWasFound
{
    public string $route;

    public string $missingUrl;

    public int $statusCode;

    public function __construct(string $route, string $missingUrl, int $statusCode = null)
    {
        $this->route = $route;
        $this->missingUrl = $missingUrl;
        $this->statusCode = $statusCode;
    }
}
