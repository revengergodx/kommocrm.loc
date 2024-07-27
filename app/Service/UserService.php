<?php

namespace App\Service;


use App\Models\Token;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class UserService extends BaseService
{

    public function getAllUsers($access_token)
    {
        $transfer = Http::withToken($access_token)->get('https://' . $this->subdomain . '.kommo.com/api/v4/users');
        $response = json_decode($transfer, true);
        return $response['_embedded'];
    }

    public function getSingleUser($access_token, $userId)
    {
        $responsibleUser = Http::withToken($access_token)->get('https://' . $this->subdomain . '.kommo.com/api/v4/users/' . $userId);
        $user = json_decode($responsibleUser, true);
        return $user;
    }

}
