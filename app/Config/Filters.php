<?php

namespace Config;

use CodeIgniter\Filters\Cors;
use CodeIgniter\Filters\CSRF;
use App\Filters\AuthFilter;
use App\Filters\StudentFilter;
use App\Filters\TeacherFilter;
use App\Filters\AdminFilter;
use App\Filters\Authorization;
use App\Filters\Authentication;
use App\Filters\ApiAuthFilter;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\PageCache;
use CodeIgniter\Filters\ForceHTTPS;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;
use CodeIgniter\Filters\PerformanceMetrics;
use CodeIgniter\Config\Filters as BaseFilters;

class Filters extends BaseFilters
{
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'cors'          => Cors::class,
        'forcehttps'    => ForceHTTPS::class,
        'pagecache'     => PageCache::class,
        'performance'   => PerformanceMetrics::class,
        'isLoggedIn'    => Authentication::class,
        'isGranted'     => Authorization::class,
        'auth'          => AuthFilter::class,
        'student'       => StudentFilter::class,
        'teacher'       => TeacherFilter::class,
        'admin'         => AdminFilter::class,
        'api_auth'      => ApiAuthFilter::class,
    ];

    public array $required = [
        'before' => [
            'pagecache',
        ],
        'after' => [
            'pagecache',
            'performance',
            'toolbar',
        ],
    ];

    public array $globals = [
        'before' => [
            'isLoggedIn' => ['except' => ['/', 'register', 'login', 'unauthorized', 'api/*']],
            'isGranted'  => ['except' => ['/', 'register', 'login', 'logout', 'blocked', 'unauthorized', 'dashboard', 'dashboard-v2', 'dashboard-v3', 'student/*', 'students', 'student', 'profile', 'profile/*', 'admin/*', 'api/*']],
        ],
        'after' => [],
    ];

    public array $methods = [];

    public array $filters = [];
}
