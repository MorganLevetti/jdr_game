<?php
require_once './src/model/ConnexionModel.php';
require_once './src/model/InscriptionModel.php';
require_once './src/view/InscriptionView.php';
require_once './src/view/HomeView.php';
require_once './src/view/Game.php';

class MainController
{
    public function handleRequest()
    {
        $action = isset($_GET['action']) ? $_GET['action'] : 'home';

        switch ($action) {
            case 'connexion':
                $this->login();
                break;

            case 'inscription':
                $this->handleInscription();
                break;

            case 'home':
            default:
                // Afficher la page d'accueil
                $this->showHome();
                break;
        }
    }
    private function showHome()
    {
        // Afficher la page d'accueil
        $homeView = new HomeView();
        $homeView->render();
    }
    private function showGame()
    {
        // Afficher la page d'accueil
        $homeView = new Game();
        $homeView->render();
    }
    private function handleInscription()
    {
        $servername = 'localhost:3306';
        $dbUser = 'root';
        $dbPass = 'root';
        $dbName = 'jdr';

        // Vérifier si le formulaire d'inscription a été soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $username = isset($_POST['username']) ? $_POST['username'] : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';
            $email = isset($_POST['email']) ? $_POST['email'] : '';

            // Valider les données
            if (!empty($username) && !empty($password) && !empty($email)) {
                // Instancier le modèle d'inscription
                $conn = new mysqli($servername, $dbUser, $dbPass, $dbName);
                $inscriptionModel = new InscriptionModel($conn);

                // Appeler la méthode d'inscription du modèle
                $inscriptionSuccessful = $inscriptionModel->registerUser($username, $password, $email);

                if ($inscriptionSuccessful) {
                    // Rediriger vers la page game après une inscription réussie
                    $this->showGame();
                    return;
                } else {
                    // Gérer les erreurs d'inscription
                    // Vous pouvez également réafficher le formulaire avec un message d'erreur
                    $inscriptionView = new InscriptionView();
                    $inscriptionView->render();
                    return;
                }
            } else {
                // Gérer les erreurs de données du formulaire
                // Vous pouvez également réafficher le formulaire avec un message d'erreur
                $inscriptionView = new InscriptionView();
                $inscriptionView->render();
                return;
            }
        }

        // Si le formulaire n'a pas été soumis, afficher le formulaire d'inscription
        $inscriptionView = new InscriptionView();
        $inscriptionView->render();
    }

    private function login(){

    }
}
