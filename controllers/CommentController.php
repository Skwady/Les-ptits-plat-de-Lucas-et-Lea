<?php

namespace App\controllers;

use App\models\CommentModel;
use App\repository\CommentRepository;

class CommentController extends Controller
{
    public function addComment($recipeId, $type)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['id'];
            $content = $_POST['content'];
            $commentRepository = new CommentRepository();
            $commentModel = new CommentModel();

            $data = [
                'content' => $content,
                'user_id' => $userId, 
                'recipe_id' => $recipeId
                ];
                
            $commentModel->hydrate($data);
            if($commentRepository->create($data)){
                http_response_code(200);
                echo json_encode(["status" => "success", "redirect" => "/recipes/listRecipes/$type#$recipeId"]);
            }else{
                http_response_code(400);
                echo json_encode(["status" => "error", "message" => "Erreur lors de l'ajout du commentaire."]);
            }
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