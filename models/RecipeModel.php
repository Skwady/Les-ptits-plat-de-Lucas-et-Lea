<?php

namespace App\models;

class RecipeModel extends Model
{
    protected $id;
    protected $title;
    protected $type;
    protected $servings;
    protected $difficulty;
    protected $prep_time;
    protected $cook_time;
    protected $ingredients;
    protected $instructions;
    protected $slug;

    public function __construct()
    {
        $this->table = 'recipes';
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
     * Get the value of title
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Set the value of title
     */
    public function setTitle($title): self {
        $this->title = $title;
        return $this;
    }

    /**
     * Get the value of type
     */
    public function getType() {
        return $this->type;
    }

    /**
     * Set the value of type
     */
    public function setType($type): self {
        $this->type = $type;
        return $this;
    }

    /**
     * Get the value of servings
     */
    public function getServings() {
        return $this->servings;
    }

    /**
     * Set the value of servings
     */
    public function setServings($servings): self {
        $this->servings = $servings;
        return $this;
    }

    /**
     * Get the value of dificulty
     */
    public function getDifficulty() {
        return $this->difficulty;
    }

    /**
     * Set the value of dificulty
     */
    public function setDifficulty($dificulty): self {
        $this->difficulty = $dificulty;
        return $this;
    }

    /**
     * Get the value of prep_time
     */
    public function getPrep_Time() {
        return $this->prep_time;
    }

    /**
     * Set the value of prep_time
     */
    public function setPrep_Time($prep_time): self {
        $this->prep_time = $prep_time;
        return $this;
    }

    /**
     * Get the value of cook_time
     */
    public function getCook_Time() {
        return $this->cook_time;
    }

    /**
     * Set the value of cook_time
     */
    public function setCook_Time($cook_time): self {
        $this->cook_time = $cook_time;
        return $this;
    }

    /**
     * Get the value of ingredients
     */
    public function getIngredients() {
        return $this->ingredients;
    }

    /**
     * Set the value of ingredients
     */
    public function setIngredients($ingredients): self {
        $this->ingredients = $ingredients;
        return $this;
    }

    /**
     * Get the value of instructions
     */
    public function getInstructions() {
        return $this->instructions;
    }

    /**
     * Set the value of instructions
     */
    public function setInstructions($instructions): self {
        $this->instructions = $instructions;
        return $this;
    }

    /**
     * Get the value of photo
     */
    public function getSlug() {
        return $this->slug;
    }

    /**
     * Set the value of photo
     */
    public function setSlug($slug): self {
        $this->slug = $slug;
        return $this;
    }
}
