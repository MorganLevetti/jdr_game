<?php
class InscriptionModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function registerUser($username, $password, $email)
    {
        // Valider les données
        if (empty($username) || empty($password) || empty($email)) {
            return false;
        }

        // Vérifier si l'utilisateur existe déjà
        if ($this->userExists($username, $email)) {
            // Gérer le cas où l'utilisateur existe déjà
            return false;
        }

        // Hacher le mot de passe
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insérer les données dans la base de données
        $query = "INSERT INTO users (username, password, email) VALUES ('$username', '$hashedPassword', '$email')";
        $result = $this->conn->query($query);

        if ($result) {
            // Inscription réussie
            return true;
        } else {
            // Gérer les erreurs d'inscription
            return false;
        }
    }

    private function userExists($username, $email)
    {
        // Vérifier si l'utilisateur existe déjà en base de données
        $username = $this->conn->real_escape_string($username);
        $email = $this->conn->real_escape_string($email);

        $query = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
        $result = $this->conn->query($query);

        return ($result && $result->num_rows > 0);
    }
}
?>