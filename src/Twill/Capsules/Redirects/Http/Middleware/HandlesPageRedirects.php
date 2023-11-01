<?php

namespace CwsDigital\TwillRedirects\Twill\Capsules\Redirects\Http\Middleware;

use Closure;
use CwsDigital\TwillRedirects\Twill\Capsules\Redirects\MissingPageRouter;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HandlesPageRedirects
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if (! $this->shouldRedirect($response)) {
            return $response;
        }

        $redirectResponse = app(MissingPageRouter::class)
            ->getRedirectFor($request);

        return $redirectResponse ?? $response;
    }

    protected function shouldRedirect($response): bool
    {
        $redirectStatusCodes = [
            Response::HTTP_NOT_FOUND,
        ];

        return in_array($response->getStatusCode(), $redirectStatusCodes);
    }
}
