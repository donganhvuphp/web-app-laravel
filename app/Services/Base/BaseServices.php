<?php

namespace App\Services\Base;

use Carbon\Carbon;

/**
 * Class BaseServices.
 *
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 * @link      https://laravel.com Laravel(tm) Project
 */
abstract class BaseServices
{
    /**
     * @param string $message
     *
     * @return array
     */
    public function returnError($message = ''): array
    {
        return [
            'success' => false,
            'message' => $message,
        ];
    }

    /**
     * @param array  $data
     * @param string $message
     *
     * @return array
     */
    public function returnSuccess($data = [], $message = ''): array
    {
        return [
            'data'    => $data,
            'success' => true,
            'message' => $message,
        ];
    }

    public function responseJson($data = [], $status = 200, $message = '')
    {
        return response(
            [
                'data'        => $data,
                'message'     => $message,
                'time' => Carbon::now(),
            ],
            $status
        );
    }
}
