<?php

namespace CwsDigital\TwillRedirects\Twill\Capsules\Redirects;

use CwsDigital\TwillRedirects\Twill\Capsules\Redirects\Events\RedirectWasFound;
use CwsDigital\TwillRedirects\Twill\Capsules\Redirects\Events\RedirectWasNotFound;
use CwsDigital\TwillRedirects\Twill\Capsules\Redirects\Repositories\RedirectRepository;
use Illuminate\Routing\Router;
use Symfony\Component\HttpFoundation\Request;

class MissingPageRouter
{
    protected $router;

    protected $redirectRepository;

    public function __construct(Router $router, RedirectRepository $redirectRepository)
    {
        $this->router = $router;
        $this->redirectRepository = $redirectRepository;
    }

    public function getRedirectFor(Request $request)
    {
        // Only interested in the first available redirect
        $redirect = $this->redirectRepository
            ->published()
            ->firstWhere('from', $request->getRequestUri());

        if ($redirect) {
            event(new RedirectWasFound($redirect->to, $request->getRequestUri(), $redirect->status_code));

            return redirect()->to(
                $redirect->to,
                $redirect->status_code,
            );
        }

        // event(new RedirectWasNotFound($request));
        return;
    }
}
