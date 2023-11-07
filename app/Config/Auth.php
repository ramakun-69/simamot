<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use Myth\Auth\Filters\LoginFilter;
use Myth\Auth\Config\Auth as AuthConfig;

class Auth extends AuthConfig
{

    public $requireActivation = null;
    public $filters = [
        'login' => LoginFilter::class,
    ];
}
