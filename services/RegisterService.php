<?php

namespace App\services;

use App\models\ProfileModel;
use App\models\UsersModel;
use App\repository\UsersRepository;
use PHPMailer\PHPMailer\PHPMailer;

class RegisterService
{
    public function register()
    {
        $name = $_POST['name'];
        $firstname = $_POST['firstname'];
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        $id_role = 2;

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            http_response_code(400);
            echo json_encode(["status" => "error", "message" => "Email invalide."]);
            exit();
        }

        if ($password !== $confirmPassword) {
            http_response_code(400);
            echo json_encode(["status" => "error", "message" => "Les mots de passe ne correspondent pas."]);
            exit();
        } else {
            $password = password_hash($password, PASSWORD_DEFAULT);
        }

        // Génération du token de confirmation
        $token = bin2hex(random_bytes(32));

        // Hydrater et enregistrer l'utilisateur avec le token
        $data = [
            'name' => $name,
            'firstname' => $firstname ?? null,
            'email' => $email,
            'password' => $password,
            'confirmed_token' => $token,
            'is_confirmed' => 0,
            'id_role' => $id_role
        ];
        
        $UsersModel = new UsersModel();
        $UsersModel->hydrate($data);
        if ($UsersModel = (new UsersRepository())->create($data)) {
            // Envoi de l'email de confirmation
            $this->sendConfirmationEmail($email, $token);

            http_response_code(200);
            echo json_encode(["status" => "success", "message" => "Un email de confirmation a été envoyé."]);
            exit();
        } else {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => "Erreur lors de la création de l'utilisateur."]);
            exit();
        }
    }

    public function sendConfirmationEmail($email, $token)
    {
            // Contenu de l'email
            $to = $email;
            $Subject = 'Confirmation de votre inscription';
            $confirmationLink = "https://lesptitsplats-ee9a18fc681e.herokuapp.com/login/confirm/" . $token;
            $Body = "Bonjour,<br>
                <br>
                Merci pour votre inscription.<br>
                Veuillez cliquer sur le lien ci-dessous pour confirmer votre adresse email :<br>
                <br>
                <a href='$confirmationLink'>Confirmer mon email</a>
                <ul>
                    <li>En cliquant sur ce lien, vous vous engagez à utiliser le site de manière respectueuse, sans tenter de le perturber, de l'endommager ou d'y porter préjudice (tentatives de piratage, diffusion de contenu nuisible, etc.).<br>
                        Les interactions entre utilisateurs doivent rester courtoises et respectueuses. Tout propos injurieux, discriminatoire ou diffamatoire est strictement interdit.</li>
                    <li>Vous vous engagez à publier uniquement des photos, recettes et commentaires liés à la cuisine et en adéquation avec le thème du blog.<br>
                        Les contenus doivent être vos créations ou des contenus que vous avez le droit de partager. La publication de contenus protégés par des droits d'auteur sans autorisation est interdite.
                        Les photos ou textes contenant des propos inappropriés, violents ou à caractère pornographique sont strictement prohibés.</li>
                    <li>Chaque utilisateur est responsable du contenu qu’il publie. En cas de non-respect des règles, votre contenu pourra être supprimé sans préavis.<br>
                        En cas de violation grave ou répétée, votre compte pourra être supprimé définitivement.</li>
                    <li>Vous êtes invité à commenter de manière constructive et bienveillante.
                        Les attaques personnelles, spam ou toute tentative de harcèlement envers d’autres utilisateurs ne seront pas tolérées.</li>
                    <li>Vous vous engagez à ne pas diffuser de données personnelles d’autres utilisateurs sans leur consentement.<br>
                        Votre compte est personnel. Le partage de vos identifiants avec des tiers est fortement déconseillé.</li>
                    <li>Toute infraction aux règles énoncées ci-dessus pourra entraîner :<br>
                        La suppression du contenu en infraction.<br>
                        Une suspension permanente du compte.<br>
                        Des actions légales en cas de préjudice grave causé au site ou à d’autres utilisateurs.</li>
                    <li>Les présentes règles sont susceptibles d’évoluer. Vous serez informé des modifications et invité à les accepter pour continuer à utiliser le site.<br>
                        Merci de respecter ces règles et de contribuer à faire de ce blog une communauté agréable et passionnée autour de la cuisine. Bon partage et bonne découverte !</li>
                    <li>Les recettes publiées sur ce site sont rédigées avec soin et testées pour garantir leur qualité et leur faisabilité. Cependant, les photos accompagnant ces recettes sont fournies à titre purement illustratif et sont non contractuelles.</li>
                </ul>";

            $emailService = new EmailService();
            $emailService->sendEmail($to, $Subject, $Body);
    }
}
