<?php

namespace App\repository;

use MongoDB\BSON\UTCDateTime;

class ActivityRepository extends BaseMongo
{
    /**
     * Récupère les activités d'un utilisateur.
     *
     * @param string $userId ID de l'utilisateur.
     * @param int $limit Limite des activités à récupérer.
     * @return array Liste des activités.
     */
    public function getUserActivities(string $userId, int $limit = 10): array
    {
        return $this->findBy('actu', ['user_id' => $userId], [
            'sort' => ['created_at' => -1], // Tri par date décroissante
            'limit' => $limit
        ]);
    }

    /**
     * Publier un message dans le fil d'actualité.
     *
     * @param string $userId ID de l'utilisateur.
     * @param string $message Contenu du message.
     * @return string ID du message publié.
     */
    public function publishMessage($data): string
    {
        return $this->create('actu', $data);
    }
}
