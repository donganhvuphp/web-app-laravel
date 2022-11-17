<?php

if (!defined('HTTP_STATUS')) {
    define('HTTP_STATUS', [
        'SUCCESS' => 200,
        'BAD_REQUEST' => 400,
        'FORBIDDEN' => 403,
        'NOT_FOUND' => 404,
        'NOT_ALLOWED' => 405,
        'PAGE_EXPIRED' => 419,
        'SERVER_ERROR' => 500,
        'SERVICE_UNAVAILABLE' => 503,
    ]);
}

if (!defined('ACTIVE')) {
    define('ACTIVE', 1);
}
