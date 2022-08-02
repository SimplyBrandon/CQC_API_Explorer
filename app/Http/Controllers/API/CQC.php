<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CQC extends Controller
{
    const CQC_API = 'https://api.cqc.org.uk/public/v1/';

    public static function request($url, $params = [])
    {
        $url = self::CQC_API . $url;
        $response = Http::get($url . '?' . http_build_query($params));

        if(isset($response->json()['message']))
        {
            return false;
        }

        return $response->json();
    }
}
