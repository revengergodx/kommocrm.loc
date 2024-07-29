<?php

namespace App\Service;


use Illuminate\Support\Facades\Http;

class TaskService extends BaseService
{

    public function getAllTasks($access_token)
    {
        $transfer = Http::withToken($access_token)->get('https://' . $this->subdomain . '.kommo.com/api/v4/tasks');
        $response = json_decode($transfer, true);
        if ($response === null) {
            return $response;
        } else {
        $response = $response['_embedded'];
        return $response['tasks'];
        }
    }

    public function getSingleTask($userService, $access_token, $id)
    {
        $transfer = Http::withToken($access_token)->get('https://' . $this->subdomain . '.kommo.com/api/v4/tasks/' . $id);
        $response = json_decode($transfer, true);
        $userId = $response['responsible_user_id'];
        $user = $userService->getSingleUser($access_token, $userId);

        $response['responsible_user_name'] = $user['name'];
        return $response;
    }

    public function sendTask($access_token, $data)
    {
        $transfer = Http::withToken($access_token)->post('https://' . $this->subdomain . '.kommo.com/api/v4/tasks',
            $data);
        return json_decode($transfer, true);
    }
}
