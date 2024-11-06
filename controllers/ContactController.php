<?php

namespace App\Controllers;

use App\Models\ContactModel;

class ContactController extends Controller
{
    public function index()
    {
        $this->render('contact/index');
    }
}