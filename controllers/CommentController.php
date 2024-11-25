<?php

namespace App\controllers;

use App\repository\CommentRepository;
use App\services\CommentService;

class CommentController extends Controller
{
    public function addComment($recipeId, $type)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $commentService = new CommentService();
            $commentService->addComment($recipeId, $type, $data);
        }else{
            http_response_code(400);
            echo json_encode(["status" => "error", "message" => "Erreur lors de l'envoie du commentaire."]);
        }
    }

    public function removeComment($commentId, $recipeId, $type)
    {
        $commentRepository = new CommentRepository();
        $commentRepository->delete($commentId);
        header("Location: /recipes/listRecipes/$type#$recipeId");
        exit();
    }
}