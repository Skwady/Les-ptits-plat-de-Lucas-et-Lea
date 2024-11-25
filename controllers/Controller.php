<?php

namespace App\controllers;

abstract class Controller 
{
    // Méthode existante pour rendre des vues
    public function render(string $file, array $donnees = [])
    {
        extract($donnees);
        ob_start();
        require_once ROOT.'/views/'.$file.'.php';
        $contenu = ob_get_clean();
        require_once ROOT.'/views/default.php';
    }

    public function renderProfile(string $file, array $donnees = [])
    {
        extract($donnees);
        
        ob_start();
        require_once ROOT . '/views/profiles/' . $file . '.php';
        $profileContent = ob_get_clean();
        
        ob_start();
        require_once ROOT . '/views/profiles/layout.php';
        $contenu = ob_get_clean();

        require_once ROOT . '/views/default.php';
    }

}
