<?php

namespace CwsDigital\TwillRedirects\Twill\Capsules\Redirects\Http\Requests;

use A17\Twill\Http\Requests\Admin\Request;

class RedirectRequest extends Request
{
    public function rulesForCreate()
    {
        return [
            'from' => 'required',
            'to' => 'required',
        ];
    }

    public function rulesForUpdate()
    {
        return [
            'from' => 'required',
            'to' => 'required',
        ];
    }
}
