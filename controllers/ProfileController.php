<?php

namespace App\controllers;

use App\repository\ActivityRepository;
use App\repository\ProfileRepository;
use App\repository\FavoriteRepository;
use App\repository\RecipeRepository;
use App\repository\UsersRepository;
use App\services\ActivityService;
use App\services\CloudinaryService;
use App\services\ProfileService;

class ProfileController extends Controller
{

    /**
     * Affiche le profil avec le fil d'actualité.
     *
     * @param string $userId ID de l'utilisateur.
     */
    public function activity(string $userId)
    {
        $activityRepository = new ActivityRepository();
        // Récupérer les activités des utilisateurs
        $activities = $activityRepository->findBy('actu', [], [
            'sort' => ['created_at' => 1],
        ]);
        
        $profilerepository = new ProfileRepository();
        $profile = $profilerepository->selectProfileByUserId($userId);

        $UserRepository = new UsersRepository();
        foreach ($activities as $activity){
            $names = $UserRepository->findBy(['id' => $activity->user_id]);
            
            foreach ($names as $name){
                $name = $name->name;
            }
        }

        if (isset($_SESSION['id']) && $_SESSION['id'] == $userId) {
            // Rendre la vue du profil avec les activités
            if(isset($name)){
                $this->renderProfile('actu/activity', [
                    'name' => $name,
                    'activities' => $activities,
                    'user_id' => $userId,
                    'profile' => $profile
                ]);
            } else if(!isset($name)){
                $this->renderProfile('actu/activity', [
                    'activities' => $activities,
                    'user_id' => $userId,
                    'profile' => $profile
                ]);
            }
        } else {
            http_response_code(404);
        }
    }

    public function viewProfile($userId)
    {
        $profilerepository = new ProfileRepository();

        // Charger les informations du profil
        $profile = $profilerepository->selectProfileByUserId($userId);

        if (isset($_SESSION['id'])) {
            // Vérifier si l'utilisateur est autorisé à voir ce profil
            if ($_SESSION['id'] == $userId || $_SESSION['role'] == 'Admin') {

                // Rendre la vue du profil avec les données
                $this->renderProfile('user/profile', [
                    'profile' => $profile,
                    'userId' => $userId
                ]);
            } else {
                // Redirection vers le profil de l'utilisateur connecté
                header("Location: /profile/viewProfile/" . $_SESSION['id']);
                exit();
            }
        } else {
            http_response_code(404);
        }
    }

    public function viewRecipeFavorite($userId)
    {
        $favoriterepository = new FavoriteRepository();
        $reciperepository = new Reciperepository();
        $profilerepository = new ProfileRepository();

        $profile = $profilerepository->selectProfileByUserId($userId);

        // Charger les recettes favorites
        $favorites = $favoriterepository->findBy(['user_id' => $userId]);

        // Charger les détails des recettes favorites
        $favoriteRecipes = [];
        foreach ($favorites as $favorite) {
            $favoriteRecipes[] = $reciperepository->find($favorite->recipe_id);
        }

        if (isset($_SESSION['id']) && $_SESSION['id'] == $userId) {
            // Rendre la vue des recettes favorites
            $this->renderProfile('user/recipeFavorite', [
                'favorites' => $favoriteRecipes,
                'profile' => $profile
            ]);
        } else {
            http_response_code(404);
        }
    }

    public function publish()
    {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $activityService = new ActivityService();
            $activityService->publishMessage();
            exit();
        }

        echo json_encode(['status' => 'error', 'message' => 'Méthode non autorisée']);
        exit(); 
    }

    public function updateProfile($userId)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            header('Content-Type: application/json');
            
            $data = $_POST;
            $profileService = new ProfileService();

            // Gestion de l'image de profil
            $imageUrl = null;
            if (!empty($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
                $cloudinaryService = new CloudinaryService();
                $imageUrl = $cloudinaryService->validateAndUploadImage($_FILES['profile_picture']);

                if (!$imageUrl) {
                    echo json_encode(['status' => 'error', 'message' => 'Erreur lors de l\'upload de l\'image']);
                    exit();
                }
            }

            // Mise à jour du profil
            $result = $profileService->updateProfile($userId, $data, $imageUrl);
            echo json_encode($result);
            exit();
        }

        if (isset($_SESSION['id']) && $_SESSION['id'] == $userId) {
            // Récupération des données du profil pour affichage

            $profileRepository = new ProfileRepository();
            $userrepository = new UsersRepository();

            $user = $userrepository->find($userId);
            $profile = $profileRepository->selectProfileByUserId($userId);

            $this->renderProfile('user/edit', [
                'profile' => $profile,
                'user' => $user,
            ]);
        } else {
            http_response_code(404);
        }
    }

    public function deleteComment()
    {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            $activityService = new ActivityService();
            $activityService->deleteComment();
            exit();
        }

        echo json_encode(['status' => 'error', 'message' => 'Méthode non autorisée.']);
        exit();
    }
}
