<?php

namespace App\repository;

class RecipeRepository extends BaseRepository
{
    public function __construct()
    {
        $this->table = 'recipes'; // Définit la table cible
    }

    public function countLikes(int $recipeId): int
    {
        $sql = "SELECT COUNT(*) as count FROM likes WHERE recipe_id = ?";
        $result = $this->req($sql, [$recipeId])->fetch();
        return $result->count ?? 0;
    }

    public function selectRecipeByType($type)
    {
        $sql = 'SELECT r.*, 
            GROUP_CONCAT(c.content SEPARATOR "||") AS content, 
            t.type
            FROM ' . $this->table . ' r
            LEFT JOIN comments c ON c.recipe_id = r.id
            LEFT JOIN type t ON t.id = r.type_id
            WHERE r.type_id = :type
            GROUP BY r.id
            ORDER BY r.id DESC';
        return $this->req($sql, ['type' => $type])->fetchAll();
    }

    public function isFavoritedByUser(int $recipeId, int $userId): bool
    {
        $sql = "SELECT 1 FROM favorite WHERE recipe_id = ? AND user_id = ? LIMIT 1";
        return $this->req($sql, [$recipeId, $userId])->fetch() !== false;
    }
}
