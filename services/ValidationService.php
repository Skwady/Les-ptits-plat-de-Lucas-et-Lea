<?php

namespace App\services;

class ValidationService
{
    public static function validateEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception("Email invalide.");
        }
    }

    public static function validatePassword(string $password, string $confirmPassword): void
    {
        if ($password !== $confirmPassword) {
            throw new \Exception("Les mots de passe ne correspondent pas.");
        }
    }
}
