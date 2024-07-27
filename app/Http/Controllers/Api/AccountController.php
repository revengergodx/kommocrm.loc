<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Token;
use App\Service\TokenService;
use Carbon\Carbon;

class AccountController extends Controller
{
    public function index($service)
    {
        $refreshToken = Token::first();
        if (isset($refreshToken)) {
            $token = $service->getAccessToken();
        } else {
            $service->getRefreshToken();
            $token = $service->getAccessToken();
        }
        return $token;
    }

}
