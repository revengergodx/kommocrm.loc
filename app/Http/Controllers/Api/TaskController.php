<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Deal\StoreRequest;
use App\Service\TaskService;
use App\Service\TokenService;
use App\Service\UserService;

class TaskController extends Controller
{
    public function index(TokenService $service, TaskService $taskService)
    {
        $token = new AccountController();
        $access_token = $token->index($service);
        return $taskService->getAllTasks($access_token);
    }

    public function create(UserService $userService, TokenService $service, TaskService $taskService)
    {
        $access_token = $service->getAccessToken();
        return ['users' => $userService->getAllUsers($access_token)];
    }

    public function store(StoreRequest $request, TokenService $service, TaskService $taskService)
    {
        $access_token = $service->getAccessToken();
        $tasks = $taskService->getAllTasks($access_token);
        $data = $request->validated();
        $check = '';
        foreach ($tasks as $task) {
            $min = $task['complete_till'];
            $max = $task['complete_till'] + $task['duration'];
            if ($data['complete_till'] >= $min && $data['complete_till'] <= $max) {
                $check = false;
                break;
            } else {
                $check = true;
            }
        }
        if ($check) {
            $data = [];
            $data[0] = $request->validated();
            return $taskService->sendTask($access_token, $data);
        } else {
            return response('Chosen time is already been taken, please choose another time range', 400);
        }
    }

    public function show(TokenService $service, TaskService $taskService, UserService $userService)
    {
        $token = new AccountController();
        $id = request('id');
        $access_token = $token->index($service);
        return $taskService->getSingleTask($userService, $access_token, $id);
    }
}
