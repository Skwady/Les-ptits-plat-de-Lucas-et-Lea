<?php

namespace App\services;

use App\models\CommentModel;
use App\repository\CommentRepository;

class CommentService
{
    public function addComment($recipeId, $type, $data)
    {
        $userId = $_SESSION['id'];
        $content = $data['content'];
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
    }
}