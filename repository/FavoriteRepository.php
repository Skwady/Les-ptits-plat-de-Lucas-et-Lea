<?php

namespace App\repository;

class FavoriteRepository extends BaseRepository
{
    public function __construct()
    {
        $this->table = 'favorite'; // Définir la table liée au modèle
    }
}
