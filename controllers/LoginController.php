<?php

namespace App\controllers;

use App\models\ProfileModel;
use App\repository\ProfileRepository;
use App\repository\UsersRepository;
use App\services\LoginService;
use App\services\RegisterService;

class LoginController extends Controller
{
    /**
     * Displays the login form.
     *
     * Renders the login view where users can enter their email and password
     * to authenticate.
     *
     * @return void Outputs the rendered login view.
     */
    public function index()
    {
        // Render the login view
        $this->render('login/index');
    }

    /**
     * Handles the login process.
     *
     * Validates the submitted email and password. If valid, it retrieves the user
     * from the database and verifies the password. Upon successful verification,
     * user data is stored in the session, allowing access to restricted areas.
     *
     * @return void Redirects to the home page upon successful login or exits with an error message on failure.
     */
    public function conect()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(["status" => "error", "message" => "Méthode de requête non autorisée."]);
            exit();
        }else {
            $data = $_POST;
            $loginService = new LoginService();
            $loginService->login($data);
        }
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $_POST;
            $RegisterService = new RegisterService();
            $RegisterService->register($data);
        }
        $this->render('login/register');
    }

    public function confirm($token)
    {
        if ($token) {
            $LoginRepository = new UsersRepository();
            $user = $LoginRepository->findByToken($token);
                
            if ($user) {
                $LoginRepository->confirmUser($user->id);

                $profileModel = new ProfileModel();
                $ProfileRepository = new ProfileRepository();

                $data = [
                    'user_id' => $user->id
                ];

                $profileModel->hydrate($data);
                $ProfileRepository->create($data);
                
                echo "Votre compte a été confirmé avec succès !";
            } else {
                echo "Lien de confirmation invalide ou expiré.";
            }
        } else {
            echo "Token manquant.";
        }
    }
}