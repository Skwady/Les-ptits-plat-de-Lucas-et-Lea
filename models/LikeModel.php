<?php

namespace App\models;

class LikeModel extends Model
{
    protected $id;
    protected $created_at;
    protected $user_id;
    protected $recipe_id;

    public function __construct()
    {
        $this->table = 'likes';
    }

    /**
     * Ajoute un "like" pour une recette par un utilisateur
     */
    public function addLike($userId, $recipeId)
    {
        $sql = "INSERT INTO {$this->table} (user_id, recipe_id) VALUES (?, ?)";
        return $this->req($sql, [$userId, $recipeId]);
    }

    /**
     * Supprime un "like" pour une recette par un utilisateur
     */
    public function removeLike($userId, $recipeId)
    {
        $sql = "DELETE FROM {$this->table} WHERE user_id = ? AND recipe_id = ?";
        return $this->req($sql, [$userId, $recipeId]);
    }

    /**
     * Récupère toutes les recettes "likées" par un utilisateur
     */
    public function getLikedRecipesByUser($userId)
    {
        $sql = "SELECT r.* FROM recipes r 
                INNER JOIN {$this->table} l ON r.id = l.recipe_id 
                WHERE l.user_id = ?";
        return $this->req($sql, [$userId])->fetchAll(\PDO::FETCH_OBJ);
    }

    /**
     * Get the value of id
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id): self {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the value of created_at
     */
    public function getCreated_At() {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     */
    public function setCreated_At($created_at): self {
        $this->created_at = $created_at;
        return $this;
    }

    /**
     * Get the value of user_id
     */
    public function getUser_Id() {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     */
    public function setUser_Id($user_id): self {
        $this->user_id = $user_id;
        return $this;
    }

    /**
     * Get the value of recipe_id
     */
    public function getRecipe_Id() {
        return $this->recipe_id;
    }

    /**
     * Set the value of recipe_id
     */
    public function setRecipe_Id($recipe_id): self {
        $this->recipe_id = $recipe_id;
        return $this;
    }
}
