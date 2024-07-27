<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Deal\StoreRequest;
use App\Service\ContactService;
use App\Service\TokenService;
use Illuminate\Support\Facades\Http;

class ContactController extends Controller
{

    public function index(TokenService $service, ContactService $contactService)
    {
        $token = new AccountController();
        $access_token = $token->index($service);
        return $contactService->getAllContacts($access_token);

//        $stages = Stage::all();
//        return $stages;
    }

    public function store(StoreRequest $request, TokenService $service)
    {
        $accessToken = $service->getAccessToken();
        $data = $request->validated();
        $data = [
            'Deal_Name' => $request->Deal_Name,
            'Stage' => $request->Stage,
        ];
        $arr = ["data" => [$data]];
        $response = Http::withHeaders(['Authorization' => 'Zoho-oauthtoken ' . $accessToken])->POST('https://www.zohoapis.eu/crm/v2/Deals', $arr);
        return $response;
    }
}
