<?php

namespace App\controllers;

use App\repository\UsersRepository;

class ListUsersController extends Controller
{
    public function index()
    {
        $UserRepository = new UsersRepository();
        $users = $UserRepository->findAll();
        if($_SESSION['role'] === 'Admin'){ 
            $this->render('listUsers/index', [
                'users' => $users
            ]);
        }else{
            http_response_code(404);
        }
    }

    public function deleteUser()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            header('Content-Type: application/json');

            $UserRepository = new UsersRepository();
            $UserRepository->delete($_POST['id']);

            echo json_encode(['success' => true]);
        }
    }
}