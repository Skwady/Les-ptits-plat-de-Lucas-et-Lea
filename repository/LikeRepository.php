<?php

namespace App\repository;

class LikeRepository extends BaseRepository
{

    public function __construct()
    {
        $this->table = 'likes';
    }

    public function countLikes($recipeId)
    {
        $sql = "SELECT COUNT(*) as count FROM {$this->table} WHERE recipe_id = ?";
        $result = $this->req($sql, [$recipeId])->fetch();
        return $result->count;
    }
}
