<?php

namespace App\services;

use App\repository\BaseMongo;

class ActivityService
{
    public function publishMessage()
    {
        $message = $_POST['message'] ?? null;
        $imageUrls = []; // Initialisation du tableau d'images

        // Vérification si un message est fourni
        if (empty($message)) {
            echo json_encode(['status' => 'error', 'message' => 'Le message ne peut pas être vide']);
            exit();
        }

        // Traitement des fichiers uploadés
        if (!empty($_FILES['image']) && is_array($_FILES['image']['tmp_name'])) {
            $cloudinaryService = new CloudinaryService();

            foreach ($_FILES['image']['tmp_name'] as $key => $tmpName) {
                if ($_FILES['image']['error'][$key] === UPLOAD_ERR_OK) {
                    $file = [
                        'tmp_name' => $tmpName,
                        'type' => $_FILES['image']['type'][$key],
                    ];

                    // Uploader l'image et récupérer l'URL
                    $imageUrl = $cloudinaryService->uploadFile($file['tmp_name']);
                    if ($imageUrl) {
                        $imageUrls[] = $imageUrl; // Ajouter l'URL au tableau
                    }
                }
            }
        }

        // Création du document dans MongoDB
        $baseMongo = new BaseMongo();
        $data = [
            'user_id' => $_SESSION['id'],
            'type' => 'texte', // Peut être adapté selon vos besoins
            'message' => $message,
            'image_url' => $imageUrls, // Tableau des URLs des images (vide si aucune image)
            'created_at' => new \MongoDB\BSON\UTCDateTime(),
        ];

        $documentId = $baseMongo->create('actu', $data);

        if ($documentId) {
            echo json_encode(['status' => 'success', 'message' => 'Message publié avec succès', 'id' => $documentId]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Erreur lors de la publication du message']);
        }
    }

    public function deleteComment() 
    {
        // Lecture des données envoyées
        $input = json_decode(file_get_contents('php://input'), true);
        $commentId = $input['comment_id'] ?? null;

        // Vérification que l'ID est fourni
        if (empty($commentId)) {
            echo json_encode(['status' => 'error', 'message' => 'ID du commentaire non fourni.']);
            exit();
        }

        $baseMongo = new BaseMongo();
        $comment = $baseMongo->find('actu', $commentId);

        // Vérification que le commentaire existe et que l'utilisateur est l'auteur
        if (!$comment) {
            echo json_encode(['status' => 'error', 'message' => 'Commentaire introuvable.']);
            exit();
        }

        if ($comment['user_id'] != $_SESSION['id']) {
            echo json_encode(['status' => 'error', 'message' => 'Vous ne pouvez pas supprimer ce commentaire.']);
            exit();
        }

        // Suppression du commentaire
        $deletedCount = $baseMongo->delete('actu', ['_id' => new \MongoDB\BSON\ObjectId($commentId)]);

        if ($deletedCount > 0) {
            echo json_encode(['status' => 'success', 'message' => 'Commentaire supprimé avec succès.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Erreur lors de la suppression.']);
        }
    }
}