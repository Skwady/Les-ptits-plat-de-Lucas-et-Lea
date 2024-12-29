<?php

namespace App\services;

use App\models\UsersModel;
use App\repository\UsersRepository;

class UsersService
{
    // Méthode pour mettre à jour un utilisateur
    public function updateUser($userId)
    {
        $name = $_POST['name'];
        $firstname = $_POST['firstname'];
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            http_response_code(400);
            echo json_encode(["status" => "error", "message" => "Email invalide."]);
            exit();
        }

        // Hydrater et enregistrer l'utilisateur avec le token
        $data = [
            'name' => $name,
            'firstname' => $firstname ?? null,
            'email' => $email
        ];

        $UsersModel = new UsersModel();
        $UsersModel->hydrate($data);
        if ($UsersModel = (new UsersRepository())->update($userId, $data)) {
            http_response_code(200);
            echo json_encode(["status" => "success", "message" => "Informations mises à jour."]);
            exit();
        } else {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => "Erreur lors de la mise à jour des informations."]);
        }
    }
}