<?php

namespace App\services;

use App\repository\ActivityRepository;
use MongoDB\BSON\UTCDateTime;

class ActivityService
{
    public function publishMessage(string $userId, string $message, ?string $imageUrl = null): bool
    {
        // Préparer les données pour MongoDB
        $data = [
            'user_id' => $userId,
            'type' => 'post',
            'message' => $message,
            'image_url' => $imageUrl,
            'created_at' => new UTCDateTime()
        ];

        // Insérer dans MongoDB via le repository
        $activityRepository = new ActivityRepository();
        return $activityRepository->create('actu', $data);
    }
}