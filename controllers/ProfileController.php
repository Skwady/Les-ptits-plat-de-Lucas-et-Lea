<?php

namespace App\controllers;

use App\repository\ActivityRepository;
use App\repository\ProfileRepository;
use App\repository\FavoriteRepository;
use App\repository\RecipeRepository;
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
    public function activity(string $userId, int $limit = 10)
    {
        $activityRepository = new ActivityRepository();
        // Récupérer les activités des utilisateurs
        $activities = $activityRepository->findBy('actu', [], [
            'sort' => ['created_at' => -1], // Tri par date décroissante
            'limit' => $limit
        ]);

        // Rendre la vue du profil avec les activités
        $this->renderProfile('actu/activity', [
            'activities' => $activities,
            'user_id' => $userId
        ]);
    }

    public function viewProfile($userId)
    {
        $profilerepository = new ProfileRepository();
        $favoriterepository = new FavoriteRepository();
        $reciperepository = new Reciperepository();

        // Charger les informations du profil
        $profile = $profilerepository->selectProfileByUserId($userId);

        // Vérifier si l'utilisateur est autorisé à voir ce profil
        if ($_SESSION['id'] == $userId || $_SESSION['role'] == 'Admin') {
            // Charger les recettes favorites
            $favorites = $favoriterepository->findBy(['user_id' => $userId]);

            // Charger les détails des recettes favorites
            $favoriteRecipes = [];
            foreach ($favorites as $favorite) {
                $favoriteRecipes[] = $reciperepository->find($favorite->recipe_id);
            }

            // Rendre la vue du profil avec les données
            $this->renderProfile('user/profile', [
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

    public function publish()
    {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $message = $_POST['message'] ?? null;
            $imageUrl = null;

            // Vérifier si un message est fourni
            if (empty($message)) {
                echo json_encode(['status' => 'error', 'message' => 'Le message ne peut pas être vide']);
                exit();
            }

            // Vérifier et uploader l'image si présente
            if (!empty($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $cloudinaryService = new CloudinaryService();
                $imageUrl = $cloudinaryService->validateAndUploadImage($_FILES['image']);

                // Si l'upload échoue
                if (!$imageUrl) {
                    echo json_encode(['status' => 'error', 'message' => 'Erreur lors de l\'upload de l\'image']);
                    exit();
                }
            }

            // Publier le message via le service
            $activityService = new ActivityService();
            $result = $activityService->publishMessage($_SESSION['id'], $message, $imageUrl);

            echo json_encode($result);
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

        // Récupération des données du profil pour affichage
        $profileRepository = new ProfileRepository();
        $user = $profileRepository->selectProfileByUserId($userId);
        $this->renderProfile('user/edit', ['user' => $user]);
    }
}
