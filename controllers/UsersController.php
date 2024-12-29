<?php

namespace App\controllers;

use App\services\UsersService;

class UsersController extends Controller
{
    public function updateUser(int $userId)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $UsersService = new UsersService();
            $UsersService->updateUser($userId);
        }else{
            json_encode(['status' => 'error', 'message' => 'Méthode non autorisée']);
        }
    }
}