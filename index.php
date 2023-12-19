<?php
session_start();

// Charger le contrôleur principal
require_once 'src/controller/MainController.php';

// Instancier le contrôleur principal
$mainController = new MainController();

// Gérer la requête
$mainController->handleRequest();
?>
