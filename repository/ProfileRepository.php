<?php

namespace App\repository;

class ProfileRepository extends BaseRepository
{

    public function __construct()
    {
        $this->table = 'profiles';
    }

    public function selectProfileByUserId($userId)
    {
        $sql = "SELECT *
        FROM $this->table 
        JOIN users ON profiles.user_id = users.id 
        WHERE user_id = :user_id";
        return $this->req($sql, ['user_id' => $userId])->fetch();
    }
}
