<?php

namespace App\models;

class ProfileModel extends model
{
    protected $id;
    protected $bio;
    protected $profile_picture;
    protected $date_of_birth;
    protected $created_at;
    protected $updated_at;
    protected $user_id;


    public function __construct()
    {
        $this->table = 'profiles';
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
     * Get the value of bio
     */
    public function getBio() {
        return $this->bio;
    }

    /**
     * Set the value of bio
     */
    public function setBio($bio): self {
        $this->bio = $bio;
        return $this;
    }

    /**
     * Get the value of profile_picture
     */
    public function getProfile_Picture() {
        return $this->profile_picture;
    }

    /**
     * Set the value of profile_picture
     */
    public function setProfile_Picture($profile_picture): self {
        $this->profile_picture = $profile_picture;
        return $this;
    }

    /**
     * Get the value of date_of_birth
     */
    public function getDate_Of_Birth() {
        return $this->date_of_birth;
    }

    /**
     * Set the value of date_of_birth
     */
    public function setDate_Of_Birth($date_of_birth): self {
        $this->date_of_birth = $date_of_birth;
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
     * Get the value of updated_at
     */
    public function getUpdated_At() {
        return $this->updated_at;
    }

    /**
     * Set the value of updated_at
     */
    public function setUpdated_At($updated_at): self {
        $this->updated_at = $updated_at;
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
}
