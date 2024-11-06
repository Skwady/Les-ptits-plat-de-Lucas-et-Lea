<?php

namespace App\controllers;

class LogoutController extends Controller
{
    /**
     * Logs the user out.
     *
     * Destroys the session, effectively logging the user out.
     *
     * @return void Redirects to the home page.
     */
    public function index()
    {
        // Destroy the session
        session_destroy();

        // Redirect to the home page
        header('Location: /');
        exit();
    }
}