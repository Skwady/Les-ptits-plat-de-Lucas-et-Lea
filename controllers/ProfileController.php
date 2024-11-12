<?php

namespace App\controllers;

use App\models\ProfileModel;

class ProfileController extends Controller
{
    public function viewProfile($userId)
    {
        $profileModel = new ProfileModel();
        $profile = $profileModel->selectProfileByUserId($userId);
        if($_SESSION['id'] == $userId || $_SESSION['role'] == 'Admin'){
            $this->render('user/profile', ['profile' => $profile, 'userId' => $userId]);
        }else{
            header("Location: /profile/viewProfile/" . $_SESSION['id']);
        }
    }

    public function updateProfile()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['id'];
            $profileModel = new ProfileModel();
            $profileModel->hydrate([
                'bio' => $_POST['bio'],
                'date_of_birth' => $_POST['date_of_birth'],
                'profile_picture' => $_FILES['profile_picture']['name'] ?? null
            ])->update($userId);

            if ($profileModel->getProfile_Picture()) {
                move_uploaded_file($_FILES['profile_picture']['tmp_name'], "uploads/" . $profileModel->getProfile_Picture());
            }

            header("Location: /profile/view");
            exit();
        }

        $this->render('user/edit');
    }
}
