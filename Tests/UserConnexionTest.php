<?php

use App\services\LoginService;
use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;

class UserConnexionTest extends TestCase
{
    /**
     * Teste l'inscription d'un utilisateur via l'API
     */
    public function testUserConnexion()
    {
        // Charger les variables d'environnement
        $dotenv = Dotenv::createImmutable(__DIR__ . '/..');
        $dotenv->load();

        // Simuler la session pour inclure un jeton CSRF
        session_start();
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

    $data = [
        'email' => 'yohann.vaslot@gmail.com',
        'password' => 'password',
        'csrf_token' => $_SESSION['csrf_token'], // Inclure le jeton CSRF
    ];

    $response = new LoginService();
    $response = $response->login($data);

    $this->assertEquals('success', $response['message']);
    }
}
