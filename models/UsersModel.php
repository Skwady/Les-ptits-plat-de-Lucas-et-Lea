<?php

namespace App\models;

class UsersModel extends Model
{
    protected $id;
    protected $name;
    protected $firstname;
    protected $email;
    protected $password;
    protected $confirmed_token;
    protected $is_confirmed;
    protected $id_role;

    /**
     * Get the value of id.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return self
     */
    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the value of name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name.
     *
     * @param string $name
     * @return self
     */
    public function setName($name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get the value of firstname.
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname.
     *
     * @param string $firstname
     * @return self
     */
    public function setFirstname($firstname): self
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * Get the value of email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email.
     *
     * @param string $email
     * @return self
     */
    public function setEmail($email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get the value of password.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password.
     *
     * @param string $password
     * @return self
     */
    public function setPassword($password): self
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Get the value of id_role.
     *
     * @return integer
     */
    public function getId_Role()
    {
        return $this->id_role;
    }

    /**
     * Set the value of id_role.
     *
     * @param integer $id_role
     * @return self
     */
    public function setId_Role($id_role): self
    {
        $this->id_role = $id_role;
        return $this;
    }

    /**
     * Get the value of is_confirmed
     */
    public function getIs_Confirmed() {
        return $this->is_confirmed;
    }

    /**
     * Set the value of is_confirmed
     */
    public function setIs_Confirmed($is_confirmed): self {
        $this->is_confirmed = $is_confirmed;
        return $this;
    }
    
    /**
     * Get the value of confirmed_token
     */
    public function getConfirmed_Token() {
        return $this->confirmed_token;
    }

    /**
     * Set the value of confirmed_token
     */
    public function setConfirmed_Token($confirmed_token): self {
        $this->confirmed_token = $confirmed_token;
        return $this;
    }
}
