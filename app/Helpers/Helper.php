<?php

namespace App\Helpers;

use Illuminate\Support\Carbon;

class Helper
{
    public static function pageAndPerPage(&$params)
    {
        $params['page'] = $params['page'] ?? config('common.default_page');
        $params['per_page'] = $params['per_page'] ?? config('common.default_per_page');
    }

    public static function formatDate($date, $format = 'Y/m/d H:i:s')
    {
        return is_null($date) ? null : Carbon::parse($date)->format($format);
    }
}
