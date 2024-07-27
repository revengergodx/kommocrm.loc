<?php

namespace App\Service;


use App\Models\Token;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class TokenService extends BaseService
{
    private string $clientId = ''; //enter here your integrationID (clientID)
    private string $clientSecret = ''; //enter here your Secret Key (clientSecret)
    private string $accessCode = ''; // enter your access code
    private string $redirectUri = ''; //enter your redirectUri

    public function getRefreshToken()
    {
        $grant_type = 'authorization_code';
        $transfer = Http::post('https://' . $this->subdomain . '.kommo.com/oauth2/access_token', [
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'grant_type' => $grant_type,
            'code' => $this->accessCode,
            'redirect_uri' => $this->redirectUri
        ]);

        $response = json_decode($transfer, true);
        $date = Carbon::now();
        $date->addMonth(3);
        Token::create(['name' => $response['refresh_token'], 'refresh_token_expire' => $date]);

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
        if (isset($response['status']) && $response['status'] <= 400) {
            DB::table('refresh_token')->delete();
        } else {
            $token = Token::find($refreshToken)->first();
            $token->access_token = $response['access_token'];
            $token->save();
            return $token->access_token;
        }
    }
}
