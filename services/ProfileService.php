<?php 

namespace App\services;

use App\models\ProfileModel;
use App\repository\ProfileRepository;

class ProfileService
{
    public function updateProfile($userId, $data, $imageUrl = null): array
    {
        $profileRepository = new ProfileRepository();
        $profileModel = new ProfileModel();

        // Préparer les données pour la mise à jour
        $updateData = [
            'bio' => $data['bio'],
            'date_of_birth' => $data['date_of_birth'],
            'profile_picture' => $imageUrl
        ];

        // Hydrater et mettre à jour
        $profileModel->hydrate($updateData);
        $isUpdated = $profileRepository->update($userId, $updateData);

        // Retourner le statut de la mise à jour
        if ($isUpdated) {
            return ['status' => 'success', 'redirect' => "/profile/viewProfile/$userId"];
        } else {
            return ['status' => 'error', 'message' => 'Échec de la mise à jour du profil'];
        }
    }
}
