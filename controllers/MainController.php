<?php

namespace App\controllers;


class MainController extends Controller
{
    /**
     * Action par défaut pour la page d'accueil.
     *
     * Traite les requêtes POST et GET pour la page d'accueil.
     *
     * @return void
     */
    public function index()
    {
        $this->render('main/index');
    }
}
