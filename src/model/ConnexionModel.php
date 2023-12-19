<?php
class ConnexionModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    private function userExist($username, $email)
    {
        $username = $this->conn->real_escape_string($username);
        $email = $this->conn->real_escape_string($email);

        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = $this->conn->query($query);

        return ($result && $result->num_rows > 0);
    }
    public function logUser($username, $email, $password){
         // Valider les données
         if (empty($username) || empty($password) || empty($email)) {
            return false;
        }
        // Vérifier si l'utilisateur existe déjà
        if ($this->userExist($username, $email)) {
            // Gérer le cas où l'utilisateur existe déjà
            return false;
        }
    }

}
?>