<?php

namespace CwsDigital\TwillRedirects\Twill\Capsules\Redirects\Models;

use A17\Twill\Models\Model;

class Redirect extends Model
{
    protected $fillable = [
        'published',
        'from',
        'to',
        'status_code',
    ];
}
