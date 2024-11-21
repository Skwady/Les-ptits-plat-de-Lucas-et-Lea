<?php

namespace App\repository;

class UsersRepository extends BaseRepository
{
    public function __construct()
    {
        $this->table = 'users';
    }

    /**
     * Searches for a user by email, returning user and role information.
     *
     * Uses the default fetch mode (object) set in the database connection.
     *
     * @param string $email The email address of the user to search for.
     * @return object|false Returns an object representing the user, or false on failure.
     */
    public function search($email)
    {
        return $this->req(
            "SELECT u.id, u.name, u.firstname, u.password, u.email, u.is_confirmed, u.id_role, r.role 
             FROM ". $this->table ." u
             JOIN role r ON u.id_role = r.id 
             WHERE u.email = :email",
            ['email' => $email]
        )->fetch();
    }

    public function findByToken($token)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE confirmed_token = ?";
        $query = $this->req($sql, [$token]);
        return $query->fetch();
    }

    public function confirmUser($id)
    {
        $sql = "UPDATE " . $this->table . " SET confirmed_token = NULL, is_confirmed = 1 WHERE id = ?";
        return $this->req($sql, [$id]);
    }
}
