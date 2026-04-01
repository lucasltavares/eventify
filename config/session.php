<?php

return [
    'session_lifetime' => env('SESSION_LIFETIME', 120),
    'session_encrypt' => env('SESSION_ENCRYPT', false),
    'session_file_limiter' => null,
    'session_cookie' => env('SESSION_COOKIE', 'eventify_session'),
    'session_path' => env('SESSION_PATH', '/'),
    'session_domain' => env('SESSION_DOMAIN'),
    'session_secure_cookie' => env('SESSION_SECURE_COOKIE'),
    'session_http_only' => env('SESSION_HTTP_ONLY', true),
    'session_same_site' => env('SESSION_SAME_SITE', 'lax'),
    'session_partitioned' => env('SESSION_PARTITIONED_COOKIE'),
    'session_httponly' => env('SESSION_HTTPONLY', true,),
    'session_driver' => env('SESSION_DRIVER', 'database'),
    'session_gc_probability' => env('SESSION_GC_PROBABILITY', 1),
    'session_gc_divisor' => env('SESSION_GC_DIVISOR', 100),
    'session_gc_maxlifetime' => env('SESSION_GC_MAXLIFETIME', 1440),
];
