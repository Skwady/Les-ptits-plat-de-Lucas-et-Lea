<?php

namespace App\controllers;

use App\models\ProfileModel;
use App\models\FavoriteModel;
use App\models\RecipeModel;

class ProfileController extends Controller
{
    public function viewProfile($userId)
    {
        $profileModel = new ProfileModel();
        $favoriteModel = new FavoriteModel();
        $recipeModel = new RecipeModel();

        // Charger les informations du profil
        $profile = $profileModel->selectProfileByUserId($userId);

        // Vérifier si l'utilisateur est autorisé à voir ce profil
        if ($_SESSION['id'] == $userId || $_SESSION['role'] == 'Admin') {
            // Charger les recettes favorites
            $favorites = $favoriteModel->selectBy(['user_id' => $userId]);

            // Charger les détails des recettes favorites
            $favoriteRecipes = [];
            foreach ($favorites as $favorite) {
                $favoriteRecipes[] = $recipeModel->select($favorite->recipe_id);
            }

            // Rendre la vue du profil avec les données
            $this->render('user/profile', [
                'profile' => $profile,
                'favorites' => $favoriteRecipes,
                'userId' => $userId
            ]);
        } else {
            // Redirection vers le profil de l'utilisateur connecté
            header("Location: /profile/viewProfile/" . $_SESSION['id']);
            exit();
        }
    }

    public function updateProfile()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['id'];
            $profileModel = new ProfileModel();

            // Mettre à jour les données du profil
            $profileModel->hydrate([
                'bio' => $_POST['bio'],
                'date_of_birth' => $_POST['date_of_birth'],
                'profile_picture' => $_FILES['profile_picture']['name'] ?? null
            ])->update($userId);

            // Gérer l'upload de l'image si elle existe
            if ($profileModel->getProfile_Picture()) {
                move_uploaded_file(
                    $_FILES['profile_picture']['tmp_name'],
                    "uploads/" . $profileModel->getProfile_Picture()
                );
            }

            header("Location: /profile/viewProfile/$userId");
            exit();
        }

        $this->render('user/edit');
    }
}
