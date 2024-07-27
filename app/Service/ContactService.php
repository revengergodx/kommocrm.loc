<?php

namespace App\Service;


use App\Models\Token;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ContactService extends BaseService
{

    public function getAllContacts($access_token)
    {
        $transfer = Http::withToken($access_token)->get('https://' . $this->subdomain . '.kommo.com/api/v4/contacts');

        $response = json_decode($transfer, true);
        return $response['_embedded'];
//        if (!isset($response['status'])) {
//            try {
//                $data = $response['refresh_token'];
//                DB::beginTransaction();
//                Token::create([
//                    'name' => $data
//                ]);
//                DB::commit();
//                return 1111;
//            } catch (Exception $exception) {
//                DB::rollBack();
//                abort(500);
//            }
//        } else {
//            abort(500);
//        }
    }

    public function getAccessToken()
    {
        $refreshToken = Token::first();
        $grant_type = 'refresh_token';
        $transfer = Http::post('https://' . $this->subdomain . '.kommo.com/oauth2/access_token', [
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'grant_type' => $grant_type,
            'refresh_token' => $refreshToken->name,
            'redirect_uri' => $this->redirectUri
        ]);


        $response = json_decode($transfer, true);
        $token = Token::find($refreshToken)->first();

//            ->update(['access_token' => $response['access_token']]);
        $token->access_token = $response['access_token'];
        $token->save();

    }
}
