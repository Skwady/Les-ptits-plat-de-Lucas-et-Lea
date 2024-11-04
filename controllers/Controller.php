<?php

namespace App\controllers;

abstract class Controller 
{
    // Méthode existante pour rendre des vues
    public function render(string $file, array $donnees = [])
    {
        extract($donnees);
        ob_start();
        require_once ROOT.'/views/'.$file.'.php';
        $contenu = ob_get_clean();
        require_once ROOT.'/views/default.php';
    }

    /**
     * Gère la soumission des formulaires de manière générique.
     *
     * Cette méthode permet de traiter toutes les soumissions de formulaires, 
     * hydrater un modèle et appeler les méthodes CRUD correspondantes.
     *
     * @param object $model L'instance du modèle à hydrater et manipuler.
     * @param string $action L'action CRUD à exécuter (create, update, delete, etc.).
     * @param array|null $idOptionnel L'ID optionnel pour les actions d'update ou delete.
     * @return void Retourne une réponse JSON pour la requête.
     */
    public function handleFormSubmission($model, string $action, $idOptionnel = null)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données POST
            $data = json_decode(file_get_contents('php://input'), true);

            // Hydrater le modèle avec les données
            $model->hydrate($data);

            // Exécuter l'action demandée (create, update, delete)
            switch ($action) {
                case 'create':
                    $result = $model->create();
                    break;
                case 'update':
                    if ($idOptionnel !== null) {
                        $result = $model->update($idOptionnel);
                    }
                    break;
                case 'delete':
                    if ($idOptionnel !== null) {
                        $result = $model->delete($idOptionnel);
                    }
                    break;
                default:
                    $result = false;
                    break;
            }

            // Retourner une réponse JSON
            if ($result) {
                echo json_encode(['status' => 'success', 'message' => ucfirst($action).' effectué avec succès.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Échec de '.ucfirst($action).'.']);
            }
        } else {
            http_response_code(405);
            echo json_encode(['status' => 'error', 'message' => 'Méthode non autorisée.']);
        }
    }
}
