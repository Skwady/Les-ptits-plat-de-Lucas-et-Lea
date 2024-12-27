<?php

namespace App\tests;

use App\repository\UsersRepository;
use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;

class EmailRepositoryTest extends TestCase
{
    public function testSearch()
    {
        // Charger les variables d'environnement
        $dotenv = Dotenv::createImmutable(__DIR__ . '/..');
        $dotenv->load();

        $email = 'yohann.vaslot@gmail.com';

        // Instancier le modèle LoginModel
        $loginModel = new UsersRepository();
        
        // Appeler la méthode search et capturer le résultat
        $result = $loginModel->search($email);

        // Vérifier que l'email dans le résultat est celui attendu
        $this->assertSame($email, $result->email);
    }
}