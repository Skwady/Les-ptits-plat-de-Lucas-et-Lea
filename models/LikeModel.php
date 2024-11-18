<?php

namespace App\models;

class LikeModel extends Model
{
    protected $id;
    protected $user_id;
    protected $recipe_id;
    protected $created_at;

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
