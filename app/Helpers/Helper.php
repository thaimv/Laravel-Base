<?php

namespace App\Helpers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class Helper
{
    public static function pageAndPerPage(&$params)
    {
        $params['page'] = $params['page'] ?? config('common.default_page');
        $params['per_page'] = $params['per_page'] ?? config('common.default_per_page');
    }

    public static function formatDateTime($date, $format = 'Y/m/d H:i:s')
    {
        return is_null($date) ? null : Carbon::parse($date)->format($format);
    }

    public static function formatTokenInfos($token)
    {
        return [
            'access_token' => $token,
            'expires_in' => Auth::factory()->getTTL() * 60,
        ];
    }
}
