<?php

namespace App\services;

use App\repository\UsersRepository;

class LoginService
{
    public function login($data)
    {
        $email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
        $password = $data['password'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            http_response_code(400);
            echo json_encode(["status" => "error", "message" => "Email invalide."]);
            exit();
        }

        $LoginRepository = new UsersRepository();
        $user = $LoginRepository->search($email);

        // Vérifier si l'utilisateur est confirmé
        if ($user && $user->is_confirmed == '0') {
            http_response_code(403);
            echo json_encode(["status" => "error", "message" => "Veuillez confirmer votre adresse email avant de vous connecter."]);
            exit();
        }

        if ($user && password_verify($password, $user->password)) {
            $_SESSION['id'] = $user->id;
            $_SESSION['name'] = $user->name;
            $_SESSION['firstname'] = $user->firstname;
            $_SESSION['email'] = $user->email;
            $_SESSION['role'] = $user->role;

            http_response_code(200);
            echo json_encode(["status" => "success", "redirect" => "/"]);
        } else {
            http_response_code(401);
            echo json_encode(["status" => "error", "message" => "Email ou Mot de passe incorrect."]);
        }
        exit();
    }
}