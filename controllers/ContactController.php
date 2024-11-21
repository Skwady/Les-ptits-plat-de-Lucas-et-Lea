<?php

namespace App\controllers;

class ContactController extends Controller
{
    public function index()
    {
        $this->render('contact/index');
    }
}