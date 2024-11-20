<?php

namespace App\models;

class TypeModel extends Model
{
    protected $id;
    protected $type;

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
}